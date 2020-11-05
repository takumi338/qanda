@extends('layouts.common')
@include('layouts.header')
@section('content')
<form method="POST" class="post-page-wrapper mt-3" action="{{ route('posts.store') }}">
@csrf
    <input name="title" type="text" class="form-control mb-2" id="title-input" placeholder="タイトル" data-step='1' data-intro='はじめにタイトルを入力してください。'>
    <input name="user_id" type="hidden" id="title-input" value="{{ Auth::id()}}">
    <input name="tags" type="text" class="form-control mb-2" placeholder="タグを入力してください" data-step='2' data-intro='次にタグを入力してください。必ずタグの初めは「#」をつけてください。'>
    <div class="row mb-2 ">
        <div class="col">
            <textarea name="content" id="markdown_editor_textarea" cols="30" rows="10" class="form-control" data-step='3' data-intro='質問内容を入力してください。マークダウン記法で記入できます。'></textarea>
        </div>
        <div class="col">
            <div id="markdown_preview"></div>
        </div>
    </div>
    <div class="post-page-footer">
        <input type="submit" class="btn btn-primary m-1" value="投稿" data-step='4' data-intro='最後に投稿ボタンを押してください。'>
    </div>
</form>

  <script>
  document.addEventListener("DOMContentLoaded", function() {
      introJs()
      .setOption('showBullets',false)
      .setOption('skipLabel', 'スキップ')
      .setOption('nextLabel','次へ')
      .setOption('prevLabel','戻る')
      .setOption('doneLabel', '終了')
      .start();
  });
  </script>

@endsection