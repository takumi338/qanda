@extends('layouts.common')
@include('layouts.header')
@section('content')

<form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}" class="mt-4">
  @method('PATCH')
    @csrf
    <input name="id" type="hidden" value="{{$comment->id}}">
    <label for="inputPassword" class="col col-form-label">コメント編集</label>
      <div class="form-group row">
        <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id() }}">
        <input name="post_id" type="hidden" id="title-input" value="{{ $comment->post_id }}">
        <div class="col">
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$comment->text}}</textarea>
          <div class="post-page-footer mt-3">
              <input type="submit" class="btn btn-primary" value="編集する">
          </div>
        </div>
      </div>
    </form>

@endsection