@extends('layouts.common')
@include('layouts.header')
@section('content')
<form method="POST" class="post-page-wrapper mt-3" action="{{ route('posts.store') }}">
@csrf
    <input name="title" type="text" class="form-control mb-2" id="title-input" placeholder="タイトル">
    <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id()}}">
    <input name="tags" type="text" class="form-control mb-2" placeholder="タグを入力してください">
    <div class="row mb-2 ">
        <div class="col">
            <textarea name="content" id="markdown_editor_textarea" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="col">
            <div id="markdown_preview"></div>
        </div>
    </div>
    <div class="post-page-footer">
        <input type="submit" class="btn btn-primary m-1" value="投稿">
    </div>
</form>

@endsection