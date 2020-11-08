@extends('layouts.common')
@include('layouts.header')
@section('content')

<!-- Swiper -->
<div class="swiper-container mt-5">
    <div class="swiper-wrapper">
        <div class="row swiper-slide">
            <div class="col-md-5 mb-3 fade-in-bottom">
                {{-- <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Steps_re_odoy.svg" width="90%" height="90%"/> --}}
                <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/gamer-colour.svg" width="90%" height="90%"/>
            </div>
            <div class="col-md-7 mb-3 fade-in-bottom">
                <div class="m-4">
                    <div class="catch">
                        <h1 class="text-primary display-4 mb-3 text-center font-weight-bold">プログラミングの<br/>わからない箇所は<br/>質問してみよう。<br></h1>
                        <p class="mb-3 text-center">一人で悩むよりみんなで考えた方が解決まで早い。<br>
                            PCでもスマホからでも質問可能。さっそく質問してみよう！</p>
                        <a href="{{ route('posts.index') }}" class="start btn btn-primary text-white d-block mx-auto w-75 p-2 font-weight-bold">いますぐはじめる</a>
                     </div>
                </div>
            </div>
  
            
          </div>
      </div>
    </div>
  </div>

    <div class="mt-3">

        <h2 class="description text-center text-primary mb-4 slide-bottom show font-weight-bold">qandaとは？</h2>
        <div class="row">
          <div class="col-md-4 mb-3 slide-bottom1 show">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Questions_re_1fy7.svg" class="mx-auto d-block" width="250px" height="250px"/>
            
            <div class="mt-4">
                <p class="text-center introduction-title font-weight-bold">プログラミングの独学者にピッタリ</p>
            <p class="text-left introduction-content">プログラミングは一人で学習しているとエラーを解決できず、挫折しがち。そんなときはqandaで質問してみよう。</p>
           </div>
          </div>

          <div class="col-md-4 mb-3 slide-bottom2 show">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Freelancer_re_irh4.svg" class="mx-auto d-block" width="250px" height="250px"/>
            
            <div class="mt-4">
                <p class="text-center introduction-title font-weight-bold">オンラインで手軽に質問できる</p>
            <p class="text-left introduction-content">質問も回答もオンライン上で完結。PCでもスマホでも気軽に利用できます。</p>
           </div>
          </div>
 
          <div class="col-md-4 mb-3 slide-bottom3 show">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Bitcoin_P2P_re_1xqa.svg" class="mx-auto d-block" width="250px" height="250px"/>
            
            <div class="mt-4">
                <p class="text-center introduction-title font-weight-bold">完全無料</p>
            <p class="text-left introduction-content">qandaは完全無料でご利用いただけます。一切料金などかかりません。</p>
           </div>
          </div>
        </div>
    
</div>

@endsection


