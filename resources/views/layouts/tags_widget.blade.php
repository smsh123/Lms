@if(!empty($tags))
  <h3 class="font-weight-bold font-22 mb-3">Tags</h3>
  @php
    $i = 0;
  @endphp
  @foreach ($tags as $key => $tag )
    @if($i == 3) @php $i = 0; @endphp  @endif
    <a href="{{ !empty($tag) ? '/tags/'.str_replace(' ','-',$tag) : '' }}" class="btn rounded-pill @if($i == 0) bg-light-blue @elseif ($i == 1) bg-light-pink @else bg-light-yellow @endif mb-3 mr-2">{{ !empty($tag) ? $tag : ''}}</a>
    @php
      $i++;
    @endphp
  @endforeach
@endif