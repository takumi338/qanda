@extends('layouts.common')

@include('layouts.header')

@section('content')
<div class="container">
  @foreach ($posts as $post)
    <a href="/posts/{{ $post->id }}">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>
                    <div class="card-body">
                      <p>{{ $post->content }}</p>
                        @if(!($post->tags == '[]'))
                        @for ($i = 0; $i < $post->tags->count(); $i++)
                        #{{ $post->tags[$i]->name }}
                        @endfor
                        @endif
                        @if(Auth::id() === $post->user_id)
                        <div>
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">編集</a>
                        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" value="{{$post->id}}">
                            <input type="submit" class="btn btn-primary" value="削除">
                        </form>
                        </div>
                        @endif
                        <div>
                            @if($post->is_liked_by_auth_user())
                              <a href="{{ route('posts.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                            @else
                              <a href="{{ route('posts.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                            @endif
                          </div>
                          @if(!($post->comments->count() == 0))
                          回答数：{{ $post->comments->count() }}
                            @endif
                            <p>投稿：{{$post->updated_at}}</p>
                    </div>
                </div>
            </div> 
        </div>
    </a>
  @endforeach
  <div class="pagenate row justify-content-center mt-4">
    {{ $posts->links() }}
  </div>
</div>
@endsection
