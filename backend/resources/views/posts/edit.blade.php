@extends('layouts.common')
@include('layouts.header')
@section('content')
<form method="POST" class="post-page-wrapper mt-3" action="{{ route('posts.update', ['post' => $post]) }}">
@method('PATCH')
@csrf
<input name="title" value="{{ $post->title }}" type="text" class="form-control mb-2" id="title-input" placeholder="タイトル">
    <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id() }}">
    <input name="id" type="hidden" id="title-input" value="{{ $post->id }}">
    @if(!($post->tags == '[]'))
    @for ($i = 0; $i < $post->tags->count(); $i++)
    <input name="tags"  type="text" class="form-control mb-2" value="#{{ $post->tags[$i]->name }}" placeholder="タグを入力してください">
    @endfor
    @else
    <input name="tags" type="text" class="form-control mb-2" placeholder="タグを入力してください">
    @endif
    <div class="row mb-2">
        <div class="col">
            <textarea name="content" id="markdown_editor_textarea" cols="30" rows="10" class="form-control">{{ $post->content }}</textarea>
        </div>
        <div class="col">
            <div id="markdown_preview"></div>
        </div>
    </div>
    <div class="post-page-footer">
        <input type="submit" class="btn btn-primary m-1" value="編集する">
    </div>
</form>

@endsection