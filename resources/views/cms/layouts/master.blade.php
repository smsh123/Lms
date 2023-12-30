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
    <link href="/assets/css/tagsinput.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('/assets/css/app.css')}} />
    @php session(['global_picklist' => App\Helpers\SiteHelper::getAllPickList()]); @endphp
@php
  if(!isset(\Auth::user()->permissions) || empty(\Auth::user()->permissions)){
      \Auth::user()->permissions = [];
  }
@endphp
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
        <script src='/assets/js/tagsinput.min.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src={{asset('/assets/js/custom.js')}}></script>
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
        function CreateAndSetSlug(){
          if($('input[name="slug"]').length !== 0){
            var txt = $("#title").val().toLowerCase();
            var slugVal = txt.split(' ').join('-');
            $('input[name="slug"]').val(slugVal);
          }
        }

        //copy this function and change according course faq mapping and others

        //from here

        function selectForMap(event,targetId){
          var isChecked = event.checked;
          //alert(isChecked);
          if(isChecked){
            var entityType = event.getAttribute("entity-type");
            var selected_id = event.value;
            var selected_module = event.getAttribute("data-label");
            if($("#"+selected_id).length == 0){
              if(entityType == "module"){
                $("#"+targetId).append("<li class='d-inline-block mx-2 mb-2'><input type='hidden' id='"+selected_id+"' value='"+selected_id+"' name='module_id[]' readonly /><input type='text' name='module_name[]' class='btn btn-outline-info rounded-pill' value='"+selected_module+"' /></li>");
              }
              else if(entityType == "faq"){
                $("#"+targetId).append("<li class='d-inline-block mx-2 mb-2'><input type='hidden' id='"+selected_id+"' value='"+selected_id+"' name='faq_id[]' readonly /><input type='text' name='faq_name[]' class='btn btn-outline-info rounded-pill' value='"+selected_module+"' /></li>");
              }
              
            }
           // alert(selected_id);
          }else{
            var selected_id = event.value;
            $("#"+targetId).find("#"+selected_id).parents("li").remove();
          }
        }

        //till here

        $(document).ready(function(){
          setTimeout(function(){autoDismissAlerts();},5000);
          $('.select_to').select2();
          $('form').keypress(function(e){
              if ( e.which == 13 ) return false;
          }); 
        });
        </script>

      <script>
        var count = 2; // Initialize count for dynamically generated fields (assuming you already have one card)

          // Add More button click event
        function addMore() {
              var newCard = $('#accordionExample .card:first').clone();
              var cardId = 'card' + count;
              newCard.attr('id', cardId);
              // Update the card's ID and button attributes
              newCard.find('.card-header').attr('id', 'heading' + count);
              newCard.find('button').attr({
                  'data-target': '#collapse' + count,
                  'aria-controls': 'collapse' + count,
              });
              newCard.find('button').text("Item#"+count);
              newCard.find('a').attr({
                  'data-card-id': cardId
              });
              // Update the collapse div's ID and input names
              newCard.find('.card-body').attr('id', 'collapse' + count);
              newCard.find('input[name="title[]"]').attr('name', 'title[]');
              newCard.find('input[name="duration[]"]').attr('name', 'duration[]');

              // Reset input values
              newCard.find('input').val('');

              // Append the new card to the accordion
              $('#accordionExample').append(newCard);
              $('#accordionExample').on('click', '.delete-card', function() {
              var cardId = $(this).data('card-id');
              $('#' + cardId).remove();
          });
              // Increment the count
              count++;
          }
          $('#accordionExample').on('click', '.delete-card', function() {
              var cardId = $(this).data('card-id');
              $('#' + cardId).remove();
          });   
      </script>  
        
        <style>
        .ck.ck-editor__editable_inline>:last-child{min-height:250px;}
        </style>
  </body>
</html>
