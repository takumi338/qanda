@extends('layouts.common')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>
                  <div class="card-body">
                    {{ $post->content }}
                  </div>
            </div>
        </div> 
    </div>
</div>
@endsection
