@extends('layouts.common')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー詳細</div>
                  <div class="card-body">
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
