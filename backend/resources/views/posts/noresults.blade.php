<head>
    <style>
        html,
        body {
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 80vh;
            margin: 0;
        }
    
        .full-height {
            height: 80vh;
        }
    
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
    
        .position-ref {
            position: relative;
        }
    
        .content {
            text-align: center;
        }
    
        .title {
            font-size: 30px;
            padding: 20px;
        }
        </style>
</head>
@extends('layouts.common')

@include('layouts.header')

@section('sidebar-content')
    @include('layouts.sidebar')
@endsection

@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
        <i class="far fa-times-circle fa-7x text-primary"></i>
        <div class="title">
            お探しのページはございません。</br>別のキーワードで検索してみてください。
        </div>
    </div>
</div>
@endsection