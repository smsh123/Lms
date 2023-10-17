<div class="bg-theme-contrast py-3 px-3">
  <div class="container text-center text-white font-weight-bold">
    <p class="mb-0">
      <span class="brand-txt mx-2 align-middle">ARYABHATT Class</span>
      launches specialised courses for class 10th & 12th Exam. <a class="text-white align-middle px-3" href="#"> Know More <i class="bi bi-arrow-right mx-2"></i></a>
    </p>
  </div>
</div>
<div class="gloabl-header" style="background-color: #fff;">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
          <img src="/assets/image/logo.png" class="brand-logo" alt="AryaBhat Classes" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link px-3" href="#">Study Materials</a> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#">BYJU'S Answer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#">Scholarship</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#">BTC</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="#">Success Stories</a>
            </li>
          </ul>
            <form class="form-inline my-2 my-lg-0">
              <button class="btn bg-transparent text-dark mx-2 my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
              <button class="btn btn-theme-contrast my-2 mx-2 my-sm-0" type="submit">Buy A Course</button>
              <a href="javascript:void(0)" class="btn bg-transparent text-theme-contrast my-2 my-sm-0" type="submit" onclick="openLoginWindow()">Login</a>
            </form>
        </div>
    </nav>
  </div>
</div>
<style>
  .screen_fed{
    position:fixed;
    top:0px;
    right:0px;
    left:0px;
    bottom:0px;
    z-index:1030;
    display:none;
    transition:all 0.5s;
    background-color:black;
    opacity:0.6;
  }
  .login_window{
    z-index: 1040;
    top: 0;
    right: -100%;
    bottom: 0;
    width:100%;
    max-width:450px;
    transition:all 0.5s;
  }
  .login_window.opened{
    z-index: 1040;
    top: 0;
    right: 0;
    bottom: 0;
    width:100%;
    max-width:450px;
    transition:all 0.5s;
  }
</style>
<div class="screen_fed"></div>
<div class="login_window mx-auto min-vh-100 position-fixed bg-white zindex-fixed">
    <div class="card border-0">
      <div class="card-header bg-transparent text-right border-0">
        <a href="javascript:void(0)" title="close me" onclick="closeLoginWindow()">
          <i class="bi bi-x-circle font-22 text-dark"></i>
        </a>
      </div>
      <div class="card-body">
        <div class="icon-250 mx-auto my-3">
          <div class="ratio-image image_16-9 bg-transparent">
            <img src="/assets/image/logo.png" alt="Aryabhatt Classes" />
          </div>
        </div>
        <h3 class="font-22 text-uppercase text-center"><span class="align-middle">Start</span> <span class="text-theme align-middle mx-1 font-weight-bold">Smart</span><span class="text-theme-contrast align-middle mx-1">Learning</span></h3>
        <form class="my-5 mx-auto">
          <div class="form-group">
            <input type="text" class="form-control font-22" placeholder="Mobile/Email/Username" />
          </div>
           <div class="form-group">
            <input type="password" class="form-control font-22" placeholder="Password" />
          </div>
          <div class="form-group text-center">
            <button class="btn btn-primary w-100 mw-450 mx-auto rounded-pill font-22"><span class="align-middle">Proceed</span><i class="bi bi-arrow-right-circle-fill align-middle mx-2"></i></button>
          </div>
        </form>
      </div>
      <div class="card-footer border-0 theme-contrast-gradient-container position-relative pt-5 wave_border_top_white footer"></div>
    </div>
</div>
