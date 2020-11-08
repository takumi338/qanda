@extends('layouts.common')

@include('layouts.header')

@section('sidebar-content')
    {{-- @include('layouts.sidebar') --}}
@endsection

@section('content')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0"></h2>
        <div class="card-text text-center">
            #{{ $tag->name}}
            {{ $tag->posts->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->posts as $post)
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card card-shadow"> 

                  <div class="row">
                  <div class="col-2">
                  <div class="sidebar_content">
                    <div class="card-body">
                    @if(!($post->comments->count() == 0))
                    <p class="anser">回答数</p>
                    <p class="anser_text">{{ $post->comments->count() }}</p>
                    @else
                    <p class="anser">回答数</p>
                    <p class="anser_text">0</p>
                      @endif
                    </div>
                  </div>
                  </div>
                  
                  <div class="col">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <a href="/posts/{{ $post->id }}">
                            {{ $post->title }}
                          </a>
                        </div>
                        <div class="post_time">
                          <p class="updated_time">{{$post->updated_at->diffForHumans()}}</p>
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        @if(!($post->tags == '[]'))
                        @for ($i = 0; $i < $post->tags->count(); $i++)
                        <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="tags">#{{ $post->tags[$i]->name }}</a>
                        @endfor
                        @endif
                      </div>

                      <div class="d-flex justify-content-between">
                        <div>
                          @if($post->is_liked_by_auth_user())
                            <a href="{{ route('posts.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                          @else
                            <a href="{{ route('posts.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                          @endif
                        </div>

                        <div class="d-flex">
                          <div class="user_name mr-2 text-primary">{{ $post->user->name }}</div>
                          @if ($post->user->profile_photo)
                            <div class="user_image"><img src="{{ $post->user->profile_photo }}" width="30" height="30"/></div>
                          @else
                            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/user_images/blank_profile.png" width="30" height="30"/>
                          @endif
                          </a>
                        </div>
                      </div>
                        
                          
                          

                    </div>
                  </div>
                  </div>

                
            </div>
        </div> 
    </div>
    @endforeach
  </div>
 <div class="mt-4">
</div>
@endsection