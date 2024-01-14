@if(!empty($highlights))
  <ul class="my-1 list-no-style px-0">
    @php
      $i = 0;
    @endphp
    @foreach ($highlights as $key => $highlight )
      @if($i == 3) @php $i = 0; @endphp  @endif
      <li class="font-12 mb-1">
        <i class="bi bi-check2 text-theme-contrast mr-2"></i>{{ !empty($highlight) ? $highlight : ''}}
      </li>
      @php
        $i++;
      @endphp
    @endforeach
  </ul>
@endif