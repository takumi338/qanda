@extends('layouts.common')
@include('layouts.header')
@section('content')
<form method="POST" class="post-page-wrapper" action="{{ route('posts.update', ['post' => $post]) }}">
@method('PATCH')
@csrf
<input name="title" value="{{ $post->title }}" type="text" class="form-control m-1" id="title-input" placeholder="タイトル">
    <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id() }}">
    <input name="id" type="hidden" id="title-input" value="{{ $post->id }}">
    @if(!($post->tags == '[]'))
    @for ($i = 0; $i < $post->tags->count(); $i++)
    <input name="tags"  type="text" class="form-control m-1" value="#{{ $post->tags[$i]->name }}" placeholder="タグを入力してください">
    @endfor
    @else
    <input name="tags" type="text" class="form-control m-1" placeholder="タグを入力してください">
    @endif
    <div class="row">
        <div class="col-6 m-1">
            <textarea name="content" id="markdown_editor_textarea" cols="30" rows="10" class="form-control">{{ $post->content }}</textarea>
        </div>
        <div class="col-6 m-1">
            <div id="markdown_preview"></div>
        </div>
    </div>
    <div class="post-page-footer">
        <input type="submit" class="post-button m-1" value="投稿">
    </div>
</form>

@endsection