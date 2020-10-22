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
                  <!-- dropdown -->
                  <div class="ml-auto card-text">
                    <div class="dropdown">
                      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2">
                          <i class="fas fa-ellipsis-v fa-lg text-primary"></i>
                        </button>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}">
                          <i class="fas fa-trash-alt mr-1"></i>ユーザーを削除する
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- dropdown -->
          
                  <!-- modal -->
                  <div id="modal-delete-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                          @csrf
                          @method('DELETE')
                          <input name="id" type="hidden" value="{{$user->id}}">
                          <div class="modal-body">
                            {{ $user->name }}を削除します。よろしいですか？
                          </div>
                          <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal -->
                  
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
