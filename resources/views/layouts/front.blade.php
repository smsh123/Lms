<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <link data-n-head="ssr" rel="shortcut icon" type="image/x-icon" href="/assets/image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>ARYABHATT Classes - Click To Success</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
    body{
        font-family:'Inter', sans-serif;
    }
      .theme-gradient-container{
        background-image: linear-gradient(to right, #ffffff00 , #11987e)
      }
      .theme-contrast-gradient-container{
        background-image: linear-gradient(to right, #ffffff00 , #6454c552)
      }
      
      .bg-theme-contrast{
        background-color:#566dc1;
      }
      .brand-txt{
        font-size:28px;
        line-height:32px;
        font-weight:bold;
      }
      .brand-logo{
        height:85px;
        width:auto;
      }
      .btn-theme{
        color: #fff;
        background-color: #11987e;
        border-color: #11987e;
      }
      .btn-theme-contrast{
        color: #fff;
        background-color: #566dc1;
        border-color: #566dc1;
      }
      .text-theme{
        color:#46ceb3;
      }
      .text-theme-contrast{
        color:#566dc1;
      }
      .banner-section{
        height:450px;
        width:90%;
      }
    </style>
     <style>
       .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius:25px;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius:20px;
    }
    </style>
  </head>
  <body>
    @yield('body')


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
          var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            centeredSlides: false,
            grabCursor: true,
            keyboard: {
              enabled: true,
            },
            breakpoints: {
              769: {
                slidesPerView: 2,
                spaceBetween: 20,
              },
              950: {
                slidesPerView: 2.5,
                spaceBetween: 40,
              },
            },
            scrollbar: {
              el: ".swiper-scrollbar",
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
          });
        </script>
  </body>
</html>
