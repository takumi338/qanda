@extends('layouts.common')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="far fa-user mr-2"></i>ユーザー詳細</div>
                  <div class="card-body">
                    <label for="exampleInputEmail1">プロフィール画像</label></br>
                    @if ($user->profile_photo)
                        <p>
                        <img src="{{ asset('storage/user_images/' . $user->profile_photo) }}" width="100" height="100"/></br>
                        </p>
                        @else
                        <img src="{{ asset('storage/user_images/blank_profile.png') }}" width="100" height="100"/></br>
                    @endif
                    <img src="" alt="">
                    <label for="exampleInputEmail1">名前</label>
                    <p>{{ $user->name }}</p>
                    <label for="exampleInputPassword1">メールアドレス</label>
                    <p>{{ $user->email }}</p>
                    <div>
                        <a href="/users/edit/{{ Auth::id() }}" class="btn btn-primary">編集</a>
                    </div>
                  </div>
            </div>
        </div> 
    </div>
</div>
@endsection
