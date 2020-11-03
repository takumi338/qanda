@extends('layouts.common')
@include('layouts.header')
@section('content')

<!-- Swiper -->
<div class="swiper-container mt-4">
    <div class="swiper-wrapper">
        <div class="row swiper-slide">
            <div class="col-md-5 mb-3">
                <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Steps_re_odoy.svg" width="90%" height="90%"/>
            </div>
            <div class="col-md-7 mb-3">
                <div class="m-4">
                    <div class="catch">
                        <h1 class="text-primary display-4 mb-3 text-center">プログラミングの<br/>わからない箇所は<br/>質問してみよう<br></h1>
                        <p class="mb-3 text-center">一人で悩むよりみんなで考えた方が解決まで早い。<br>
                            PCでもスマホからでも質問可能。さっそく質問してみよう！</p>
                        <a href="{{ route('posts.index') }}" class="start btn btn-primary text-white d-block mx-auto w-75 p-2">いますぐはじめる</a>
                     </div>
                </div>
            </div>
  
            
          </div>
        
      <div class="swiper-slide row">
        <div class="col-md-5 mb-3">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Chat_re_re1u.svg" width="100%" height="100%"/>
        </div>
        <div class="col-md-7 mb-3">
            <div class="m-4">
                <div class="catch">
                    <h1 class="text-primary display-4 mb-3 text-center">あなたの悩んでいる<br/>エラーはすぐに解決<br/>するはず<br/></h1>
                    <p class="mb-3 text-center">あなたが苦戦しているエラー<br>
                        みんなも考えてきたはず。さっそく相談してみよう。</p>
                    <a href="{{ route('posts.index') }}" class="start btn btn-primary text-white d-block mx-auto w-75 p-2">いますぐはじめる</a>
                 </div>
            </div>
        </div>       
      </div>
      </div>
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

    <div class="mt-3">

        <h2 class="text-center text-primary mb-4">qandaとは？</h2>
        <div class="row">
          <div class="col-md-4 mb-3">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Questions_re_1fy7.svg" class="mx-auto d-block" width="250px" height="250px"/>
            {{-- <img src="https://www.capcom.co.jp/monsterhunter/world-iceborne/topics/e-jang/images/img_bk02_l.jpg" class="mx-auto d-block rounded-circle" width="250px" height="250px" alt=""> --}}
            
            <div class="mt-4">
                <p class="text-center introduction-title">プログラミングの独学者にピッタリ</p>
            <p class="text-left introduction-content">プログラミングは一人で学習しているとエラーを解決できず、挫折しがち。そんなときはqandaで質問してみよう。</p>
           </div>
          </div>

          <div class="col-md-4 mb-3">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Freelancer_re_irh4.svg" class="mx-auto d-block" width="250px" height="250px"/>
            
            <div class="mt-4">
                <p class="text-center introduction-title">オンラインで手軽に質問できる</p>
            <p class="text-left introduction-content">質問も回答もオンライン上で完結。PCでもスマホでも気軽に利用できます。</p>
           </div>
          </div>
 
          <div class="col-md-4 mb-3">
            <img src="https://qandaphoto.s3-ap-northeast-1.amazonaws.com/top_images/undraw_Bitcoin_P2P_re_1xqa.svg" class="mx-auto d-block" width="250px" height="250px"/>
            
            <div class="mt-4">
                <p class="text-center introduction-title">完全無料</p>
            <p class="text-left introduction-content">qandaは完全無料でご利用いただけます。一切料金などかかりません。</p>
           </div>
          </div>
        </div>
 
    
</div>

@endsection
