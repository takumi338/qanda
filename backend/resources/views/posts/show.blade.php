@extends('layouts.common')

@include('layouts.header')

@section('sidebar-content')
 @include('layouts.sidebar')
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card"> 
          <div class="card-header_title">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col">
                  {{ $post->title }}
                </div>
                <div>
                  @if( Auth::id() === $post->user_id )
                  <!-- dropdown -->
                  <div class="ml-auto card-text">
                    <div class="dropdown">
                      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2">
                          <i class="fas fa-ellipsis-v fa-lg text-primary"></i>
                        </button>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $post]) }}">
                          <i class="fas fa-pen mr-1"></i>記事を編集する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                          <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- dropdown -->
                  <!-- modal -->
                  <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                          @csrf
                          @method('DELETE')
                          <div class="modal-body">
                            {{ $post->title }}を削除します。よろしいですか？
                          </div>
                          <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal -->
                @endif
                </div>              
              </div>
            </div>
          </div>              
              <div class="col">
                <div class="card-body">
                  <p class="post_content text-dark">{{ $post->content }}</p>
                  <div class="mb-3">
                    @if(!($post->tags == '[]'))
                    @for ($i = 0; $i < $post->tags->count(); $i++)
                    <a href="#" class="tags">#{{ $post->tags[$i]->name }}</a>
                    @endfor
                    @endif
                  </div>
                    <div class="mb-2">
                        @if($post->is_liked_by_auth_user())
                          <a href="{{ route('posts.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                        @else
                          <a href="{{ route('posts.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                        @endif
                      </div>
                        <p class="updated_time">投稿：{{date('Y年n月j日 H:i', strtotime($post->updated_at))}}</p>
                </div>
              </div>
        </div>
    </div> 
</div>
    @if(!($post->comments == '[]'))
      <div class="comments">
        <div class="row justify-content-center mt-4">
            <div class="col">
            　<p>回答{{$post->comments->count()}}件</p>
                <div class="card">
                    <div class="card-body">

                        @for ($i = 0; $i < $post->comments->count(); $i++)
                            <div class="d-flex justify-content-between mb-2">
                              <div class="d-flex">
                                <div class="user_name mr-2">{{ $post->comments[$i]->user->name }}</div>
                                <div class="user_image"><img src="{{ $post->comments[$i]->user->profile_photo }}" width="20" height="20"/></div>
                              </div>

                                  
                              <div class="d-flex">
                                <div class="updated_time">{{date('Y年n月j日 H:i', strtotime($post->comments[$i]->updated_at))}}</div>
                                <div>

                 @if( Auth::id() === $post->comments[$i]->user_id )
                  <!-- dropdown -->
                  <div class="ml-auto card-text">
                    <div class="dropdown">
                      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2">
                          <i class="fas fa-angle-down fa-lg text-primary"></i>
                        </button>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/comments/edit/{{$post->comments[$i]->id}}">
                          <i class="fas fa-pen mr-1"></i>コメントを編集する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                          <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- dropdown -->
          
                  <!-- modal -->
                  <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('comments.destroy') }}">
                          @csrf
                          @method('DELETE')
                          <input name="id" type="hidden" value="{{$post->comments[$i]->id}}">
                          <div class="modal-body">
                            コメントを削除します。よろしいですか？
                          </div>
                          <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal -->
                @endif
                                </div> 
                            </div>
                              </div>
                                
                          <p id="comment">
                                {{ $post->comments[$i]->text }}
                            </p>
                        @endfor
                    </div>
                </div>
              </div>
            </div> 
        </div>
    @endif
</div>

<form method="POST" action="/comments/store" class="mt-4">
  <label for="inputPassword" class="col col-form-label">コメント</label>
  @csrf
    <div class="form-group row">
      <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id() }}">
      <input name="post_id" type="hidden" id="title-input" value="{{ $post->id }}">
      <div class="col">
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        <div class="post-page-footer mt-3">
            <input type="submit" class="btn btn-primary" value="回答する">
        </div>
      </div>
    </div>
  </form>
@endsection
