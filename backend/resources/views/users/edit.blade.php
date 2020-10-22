@extends('layouts.common')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <div>
                    <i class="far fa-user mr-2"></i>ユーザー編集
                  </div>
                  <div>
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      <i class="fas fa-ellipsis-v fa-lg	"></i>
                    </a>
  
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
  
  
                      <a class="dropdown-item" href="{{ route('users.destroy') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete').submit();">
                            {{ __('削除') }}
                        </a>
  
                        <form id="delete" action="{{ route('users.destroy') }}" method="POST" style="display: none;">
                          @method('DELETE')
                          @csrf
                          <input name="id" type="hidden" value="{{$user->id}}">
                        </form>
  
                    </div>
                  </div>
                  
                </div>
                  <div class="card-body">
                    <form method="POST" action="/users/update" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <input value="{{ $user->id }}" type="hidden" name="id">
                          <label for="exampleInputEmail1">プロフィール画像</label></br>
                          <input type="file" name="user_profile_photo"></br>
                          <label class="mt-3" for="exampleInputEmail1">名前</label>
                          <input name="name" value="{{ $user->name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">メールアドレス</label>
                          <input name="email" value="{{ $user->email }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">保存する</button>
                      </form>

                      {{-- <button class="btn btn-primary"
                      
                        onclick="event.preventDefault();
                                      document.getElementById('delete').submit();"
                                      location.href="{{ route('users.destroy') }}">
                         {{ __('削除する') }}
                      </button>
                      <form id="delete" action="{{ route('users.destroy') }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                        <input name="id" type="hidden" value="{{$user->id}}">
                      </form> --}}
                  </div>
            </div>
        </div> 
    </div>
</div>
@endsection
