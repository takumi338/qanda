@extends('layouts.common')
@include('layouts.header')
@section('content')
<form method="POST" class="post-page-wrapper" action="{{ route('posts.store') }}">
@csrf
    <input name="title" type="text" class="form-control m-1" id="title-input" placeholder="タイトル">
    <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id()}}">
    {{-- <input type="text" class="form-control m-1" placeholder="プログラミング技術に関するタグをスペース区切りで3つまで入力" name="tags"> --}}
    <div class="row">
        <div class="col-6 m-1">
            <textarea name="content" id="markdown_editor_textarea" cols="30" rows="10" class="form-control"></textarea>
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