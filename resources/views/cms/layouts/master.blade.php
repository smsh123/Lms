<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <link data-n-head="ssr" rel="shortcut icon" type="image/x-icon" href="/assets/image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <title>ARYABHATT Classes - Click To Success</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css" />


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
  @php
    $isUserLoggedin = false;
    $isUserLoggedin = \Auth::user();
  @endphp
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow justify-content-end justify-content-lg-between">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">AryaBhatt CMS</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  @if($isUserLoggedin)
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a href="/profile/{{ !empty(\Auth::user()->id) ? \Auth::user()->id : '' }}" class="nav-link text-white" >
          <div class="d-flex">
            <div class="align-self-center">
              <div class="icon-24 d-inline-block"><div class="ratio-image image_1-1 rounded-circle"><img src="{{ !empty(\Auth::user()->avatar_image) ? \Auth::user()->avatar_image : 'https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg' }}"  alt="username" onerror="this.src='https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg';" /></div></div>
            </div>
            <div class="flex-fill align-self-center pl-2">{{ !empty(\Auth::user()->name) ? \Auth::user()->name : 'Admin' }}</div>
          </div>
        </a>
      </li>
    </ul>
  @endif
</nav>

<div class="container-fluid">
  <div class="row">
    @if($isUserLoggedin)
      @include('cms.layouts.navbar')
    @endif

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      @yield('body')
    </main>
  </div>
</div>
  @if (session('error'))
    <div class="alert alert-danger custom-alert font-weight-bold">
        {{ session('error') }}
    </div>
  @elseif (session('msg'))
    <div class="alert alert-success custom-alert font-weight-bold">
        {{ session('msg') }}
    </div>
  @elseif (session('msg_focus'))
    <div class="alert alert-warning alert-fixed alert-dismissible fade show" role="alert">
      {!! html_entity_decode(session('msg_focus')) !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
      <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <script src="/assets/js/bootstrap.bundle.min.js"></script>

      
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="/assets/js/dashboard.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <script>
        if($('.txteditor').length !== 0){
          ClassicEditor
                .create( document.querySelector( '.txteditor' ) )
                .catch( error => {
                    console.error( error );
          } );
        }

        function autoDismissAlerts(){
          $(document).find(".custom-alert").each(function(){
            $(this).hide();
          })
        }
        
        function uploadImage(image1,element){

          //  $('.fullpage_loader').show();
       

          var form = new FormData();
          image = $("#inputBanner")[0].files[0];
        //  image = document.getElementById('inputBanner');
          form.append("image", image);
         // var params = {'image' : image,'element' : element};
          $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url:'/image-upload-post',
            type: 'POST',
            method: 'POST',
            enctype: 'multipart/form-data',
            data:form,
            success:function(data) {
               console.log(data);
            },
            error: function (msg) {
               console.log(msg);
               var errors = msg.responseJSON;
            }
          });
        //  $('.fullpage_loader').hide();
        }
        $(document).ready(function(){
          setTimeout(function(){autoDismissAlerts();},5000);
        });
        </script>
        
        <style>
        .ck.ck-editor__editable_inline>:last-child{min-height:250px;}
        </style>
  </body>
</html>
