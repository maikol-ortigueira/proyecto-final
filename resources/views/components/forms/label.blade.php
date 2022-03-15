@props(['field', 'label','required' => false])
<label for="{{ $field }}" {{ $attributes->merge(["class"=>"capitalize"]) }}>
  {{ $label }}
  @if ($required)
    <span class="ml-1">(*)</span>
  @endif
</label>
