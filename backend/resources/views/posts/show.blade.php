@extends('layouts.common')

@include('layouts.header')

@section('sidebar-content')
 @include('layouts.sidebar')
@endsection

@section('content')

<div class="container fade-in-bottom">
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
                          <i class="fas fa-pen mr-1"></i>投稿を編集する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('posts.destroy', ['post' => $post]) }}"
                               onclick="event.preventDefault();
                                             document.getElementById('post_destroy').submit();">
                                <i class="fas fa-trash-alt mr-1"></i>{{ __('投稿を削除する') }}
                        </a>
                        <form id="post_destroy" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            <input name="id" type="hidden" value="{{ $post->id }}">
                        </form>
                      </div>
                    </div>
                  </div>

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
                      <a href="{{ route('tags.show', ['name' => $post->tags[$i]->name]) }}" class="tags">#{{ $post->tags[$i]->name }}</a>
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
                                  @if ($post->comments[$i]->user->profile_photo)
                                    <div class="user_image"><img src="{{ $post->comments[$i]->user->profile_photo }}" width="30" height="30"/></div>
                                  @else
                                    <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/user_images/blank_profile.png" width="30" height="30"/>
                                  @endif
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
                        <a class="dropdown-item text-danger" href="{{ route('comments.destroy') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('comment_destroy').submit();">
                                <i class="fas fa-trash-alt mr-1"></i>{{ __('コメントを削除する') }}
                            </a>

                            <form id="comment_destroy" action="{{ route('comments.destroy') }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                                <input name="id" type="hidden" value="{{$post->comments[$i]->id}}">
                            </form>
                      </div>
                    </div>
                  </div>
                  <!-- dropdown -->
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

<form method="POST" action="/comments/store" class="mt-4 fade-in-bottom2">
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
