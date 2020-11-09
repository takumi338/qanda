<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @yield('title')
  </title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/intro.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/layouts.css') }}" rel="stylesheet">
  <link href="{{ asset('css/introjs.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>
  <div id="loading" class="loading active">
    <div class="loadingtext"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i></div>
  </div>
  <div id="app">
    <div class="container">
      @include('error')
      <div class="row">
        @yield('sidebar-content')
      <div class="col">
        @yield('content')
      </div>
      </div>
      </div>
  </div>
  @include('layouts.footer')
  
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    @if (session('flash_message'))
        $(function () {
                toastr.success('{{ session('flash_message') }}');
        });
    @endif

  function loaded(){
      document.getElementById("loading").classList.remove("active");
  }

  window.addEventListener("load", function(){
      setTimeout(loaded, 500);
  })

  setTimeout(loaded, 5000);

$(function(){
   $(window).on('load scroll', function() {
      var winScroll = $(window).scrollTop();
      var winHeight = $(window).height();
      var scrollPos = winScroll + (winHeight * 0.8);

      $(".show").each(function() {
         if($(this).offset().top < scrollPos) {
            $(this).css({opacity: 1, transform: 'translate(0, 0)'});
         }
      });
   });
});
</script>
</body>

</html>
