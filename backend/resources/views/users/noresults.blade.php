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
                                <img src="{{ $user->profile_photo }}" width="100" height="100"/></br>
                                </p>
                                @else
                                <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/user_images/blank_profile.png" width="100" height="100"/></br>
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
    <p class="text-center noanswer">質問はまだ投稿されていません。</p>
@endsection
