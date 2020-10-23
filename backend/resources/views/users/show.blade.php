@extends('layouts.common')

@include('layouts.header')

@section('sidebar-content')
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="container">
            <div class="row justify-content-center my-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header text-center"><i class="far fa-user mr-2"></i>プロフィール</div>
                          <div class="card-body text-center">
                            @if ($user->profile_photo)
                                <p>
                                <img src="{{ asset('storage/user_images/' . $user->profile_photo) }}" width="100" height="100"/></br>
                                </p>
                                @else
                                <img src="{{ asset('storage/user_images/blank_profile.png') }}" width="100" height="100"/></br>
                            @endif
                            <p class="profile_name">{{ $user->name }}</p>
                            <div class="row justify-content-around">
                              <div>
                                <label for="exampleInputEmail1">投稿数</label>
                                <p class="profile_name">{{ $user->posts->count() }}</p>
                              </div>
                              <div>
                                <label for="exampleInputEmail1">回答数</label>
                                <p class="profile_name">{{ $user->comments->count() }}</p>
                              </div>
                              
                            </div>

                            @if(Auth::id() === $user->id)
                            <div>
                                <a href="/users/edit/{{ Auth::id() }}" class="btn btn-primary">プロフィール編集</a>
                            </div>
                            @endif
                          </div>
                    </div>
                </div> 
            </div>
        </div>
</div>
@endsection

@section('content')
<p class="mt-4">{{$user->name}}さんが投稿した質問</p>
@foreach ($posts as $post)
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
                                {{-- <p>投稿：{{date('Y年n月j日 H:i', strtotime($post->updated_at))}}</p> --}}
                                <p class="updated_time">{{$post->updated_at->diffForHumans()}}</p>
                              </div>
                            </div>
                            
                            <div class="mb-3">
                              @if(!($post->tags == '[]'))
                              @for ($i = 0; $i < $post->tags->count(); $i++)
                              <a href="#" class="tags">#{{ $post->tags[$i]->name }}</a>
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

                              <a href="/users/{{$post->user->id}}">
                              <div class="d-flex">
                                <div class="user_name mr-2 text-primary">{{ $post->user->name }}</div>
                                <div class="user_image"><img src="{{ asset('storage/user_images/' . $post->user->profile_photo) }}" width="30" height="30"/></div>
                              </div>
                            </a>
                            </div>
                              
                                
                                

                          </div>
                        </div>
                        </div>

                      
                  </div>
              </div> 
          </div>
    @endforeach
    <div class="pagenate row justify-content-center mt-4">
        {{ $posts->links() }}
      </div>
@endsection
