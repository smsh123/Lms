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
     <link rel="stylesheet" href="/assets/css/app.css" />
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
     .autoplay-progress {
      position: absolute;
      right: 16px;
      bottom: 16px;
      z-index: 10;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--swiper-theme-color);
    }

    .autoplay-progress svg {
      --progress: 0;
      position: absolute;
      left: 0;
      top: 0px;
      z-index: 10;
      width: 100%;
      height: 100%;
      stroke-width: 4px;
      stroke: var(--swiper-theme-color);
      fill: none;
      stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
      stroke-dasharray: 125.6;
      transform: rotate(-90deg);
    }

    .card-swiper .swiper-slide:nth-child(1n) {
      background-color: rgb(206, 17, 17);
    }

    .card-swiper .swiper-slide:nth-child(2n) {
      background-color: rgb(0, 140, 255);
    }

    .card-swiper .swiper-slide:nth-child(3n) {
      background-color: rgb(10, 184, 111);
    }

    .card-swiper .swiper-slide:nth-child(4n) {
      background-color: rgb(211, 122, 7);
    }

    .card-swiper .swiper-slide:nth-child(5n) {
      background-color: rgb(118, 163, 12);
    }

    .card-swiper .swiper-slide:nth-child(6n) {
      background-color: rgb(180, 10, 47);
    }

    .card-swiper .swiper-slide:nth-child(7n) {
      background-color: rgb(35, 99, 19);
    }

    .card-swiper .swiper-slide:nth-child(8n) {
      background-color: rgb(0, 68, 255);
    }

    .card-swiper .swiper-slide:nth-child(9n) {
      background-color: rgb(218, 12, 218);
    }

    .card-swiper .swiper-slide:nth-child(10n) {
      background-color: rgb(54, 94, 77);
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
      const progressCircle = document.querySelector(".autoplay-progress svg");
      const progressContent = document.querySelector(".autoplay-progress span");
      var swiper = new Swiper(".swiper_with_progress", {
        spaceBetween: 30,
        centeredSlides: false,
        slidesPerView: 1.3,
        {{-- autoplay: {
          delay: 3500,
          disableOnInteraction: false
        }, --}}
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            769: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            950: {
              slidesPerView: 3,
              spaceBetween: 40,
            },
          },
        on: {
          autoplayTimeLeft(s, time, progress) {
            progressCircle.style.setProperty("--progress", 1 - progress);
            progressContent.textContent = `${Math.ceil(time / 1000)}s`;
          }
        }
      });
    </script>
    
    <script>
      var swiper = new Swiper(".card-swiper", {
        effect: "cards",
        grabCursor: true,
      });
    </script>
    <script>
      var swiper = new Swiper(".card_swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: false,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      });
    </script>
    <script>
      $(document).ready(function(){
        $(".swiper").each(function(){
          var wrapper_height = $(this).find(".swiper-wrapper").height()+"px";
          $(this).find(".swiper-slide").css("height",wrapper_height);
        })
      });
    </script>
  </body>
</html>