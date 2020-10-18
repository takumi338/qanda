@extends('layouts.common')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>
                  <div class="card-body">
                    {{ $post->content }}
                  </div>
            </div>
        </div> 
    </div>

    <form method="POST" action="/comments/update" class="mt-4">
      @csrf
        <div class="form-group row">
          <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id() }}">
          <input name="post_id" type="hidden" id="title-input" value="{{ $post->id }}">
          <label for="inputPassword" class="col-sm-2 col-form-label">コメント：</label>
          <div class="col-sm-10">
            <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            <div class="post-page-footer mt-3">
                <input type="submit" class="post-button m-1" value="投稿">
            </div>
          </div>
        </div>
      </form>

    @if(!($post->comments == '[]'))
      <div class="comments">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @for ($i = 0; $i < $post->comments->count(); $i++)
                            <p>
                                {{ $post->comments[$i]->user->name }}
                                <img src="{{ asset('storage/user_images/' . $post->comments[$i]->user->profile_photo) }}" width="20" height="20"/>
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
@endsection
