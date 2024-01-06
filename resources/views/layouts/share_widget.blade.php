
 <div class="row">
  <div class="col-lg-6 vertical-align-middle">
    <ul class="my-lg-2 my-1 px-0 py-0">
      <li class="d-inline-block mr-2"><span>Share - </span></li>
      <li class="d-inline-block mx-1">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ !empty($url) ? $url : ''}}" target="_blank">
          <i class="bi bi-facebook font-22"></i>
        </a>
      </li>
      <li class="d-inline-block mx-1">
        <a href="https://twitter.com/intent/tweet?text={{ !empty($caption) ? $caption : ''}}&url={{ !empty($url) ? $url : ''}}" target="_blank" class="text-dark">
          <i class="bi bi-twitter-x font-22"></i>
        </a>
      </li>
      <li class="d-inline-block mx-1">
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ !empty($url) ? $url : ''}}&title={{ !empty($caption) ? $caption : ''}}">
          <i class="bi bi-linkedin font-22"></i>
        </a>
      </li>
      <li class="d-inline-block mx-1">
        <a href="https://www.reddit.com/submit?url={{ !empty($url) ? $url : ''}}&title={{ !empty($caption) ? $caption : ''}}" target="_blank" class="text-warning">
          <i class="bi bi-reddit font-22"></i>
        </a>
      </li>
      <li class="d-inline-block mx-1">
        <a href="https://wa.me/?text={{ !empty($caption) ? $caption.' ' : ''}}{{ !empty($url) ? $url : ''}}" target="_blank" class="text-success">
          <i class="bi bi-whatsapp font-22"></i>
        </a>
      </li>
      <li class="d-inline-block mx-1">
        <a href="mailto:?subject={{ !empty($caption) ? $caption : ''}}&body={{ !empty($url) ? $url : ''}}" class="text-danger">
          <i class="bi bi-envelope font-22"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="col-lg-6 vertical-align-middle text-left text-lg-right">
    <div class="d-inline-block my-lg-1 my-2 px-0 py-0">
      <a href="https://whatsapp.com/channel/0029VaInZ3K1yT20IQutIV1t" class="btn btn-outline-success rounded-pill" title="follow our whatsapp channel">
        <i class="bi bi-whatsapp font-16 align-middle"></i><span class="font-16 mx-2 align-middle">Follow Whatsapp Channel</span>
      </a>
    </div>
  </div>
 </div>