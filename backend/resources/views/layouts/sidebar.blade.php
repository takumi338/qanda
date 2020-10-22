<div class="col-xs-12 col-sm-12 col-md-3">
    <div class="sidebar_content">
      <div class="sidebar_content mt-4">
        <form method="GET" action="/">
          <div class="form-group mb-4">
            <label class="mb-4 d-block text-center text-primary" for="exampleInputEmail1"><i class="far fa-comment mr-1"></i>質問を検索する</label>
            <input name="keyword" type="text" class="form-control" placeholder="キーワードを入力してください">
          </div>
          <div class="text-center">
            <button type="submit" class="col-xs-8 col-sm-8 btn btn-primary"><i class="fas fa-search mr-1"></i>質問検索</button>
          </div> 
        </form>
      </div>
    </div>

    <div class="sidebar_content">
      <div class="sidebar_content mt-4">
        @foreach ($tags as $tag)
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="d-inline-block tags mb-1 mr-1">#{{$tag->name}}</a> 
        @endforeach
      </div>
    </div>

</div>