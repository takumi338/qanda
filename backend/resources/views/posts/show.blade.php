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
          <a class="card-header_title" href="/posts/{{ $post->id }}">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col">
                  {{ $post->title }}
                </div>
                
                <div>
                  @if(Auth::id() === $post->user_id)
                  <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fas fa-ellipsis-v fa-lg	"></i>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a href="/posts/{{ $post->id }}/edit" class="dropdown-item">編集</a>

                    <a class="dropdown-item" href="{{ route('posts.destroy', ['post' => $post]) }}"
                         onclick="event.preventDefault();
                                       document.getElementById('delete').submit();">
                          {{ __('削除') }}
                      </a>

                      <form id="delete" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" value="{{$post->id}}">
                      </form>

                  </div>
                  @endif
                </div>              
              </div>
                
                
            </div>
          </a>              
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
                                <div class="user_image"><img src="{{ asset('storage/user_images/' . $post->comments[$i]->user->profile_photo) }}" width="20" height="20"/></div>
                              </div>
                                <div class="updated_time">{{date('Y年n月j日 H:i', strtotime($post->comments[$i]->updated_at))}}</div>
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

<form method="POST" action="/comments/update" class="mt-4">
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
