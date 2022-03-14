@props(['value', 'outline' => false, 'secondary' => false, 'size' => false])
@if ($secondary)
  @php
    $color = 'secondary';
  @endphp
@else
  @php
    $color = 'primary';
  @endphp
@endif
@switch($size)
  @case('large')
    @php
    $size = 'h-12 px-6 text-lg';
    @endphp
  @break

  @case('small')
    @php
    $size = 'h-8 px-4 text-sm';
    @endphp
  @break

  @default
    @php
    $size = 'h-10 px-5';
    @endphp
@endswitch
@if ($outline)
  @php $clase = " text-{$color}-700 border border-{$color}-500 hover:bg-{$color}-500 hover:text-{$color}-100" @endphp
@else
  @php $clase = " text-{$color}-100 bg-{$color}-700 hover:bg-{$color}-800" @endphp
@endif
<button
  {{ $attributes->merge([
      'class' => "{$size} transition-colors duration-150 rounded-lg focus:shadow-outline{$clase}",
  ]) }}>
  {{ __($value) }}
</button>
