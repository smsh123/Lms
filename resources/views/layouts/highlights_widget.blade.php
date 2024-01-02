@if(!empty($highlights))
  <div class="py-2">
    @php
      $i = 0;
    @endphp
    @foreach ($highlights as $key => $highlight )
      @if($i == 3) @php $i = 0; @endphp  @endif
      <span class="btn rounded-pill font-12 @if($i == 0) bg-light-blue border-dark-blue @elseif ($i == 1) bg-light-pink @else bg-light-yellow @endif mb-1 mr-1">
        {{ !empty($highlight) ? $highlight : ''}}
      </span>
      @php
        $i++;
      @endphp
    @endforeach
  </div>
@endif