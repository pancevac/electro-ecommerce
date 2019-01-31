<div class="order-notes">
  <textarea
      class="input"
      id="{{ $id }}"
      name="{{ $name }}"
      placeholder="{{ $placeholder }}"
      @if(isset($required) && $required) required @endif
      @if(isset($readonly) && $readonly) readonly @endif
      @if(isset($disabled) && $disabled) disabled @endif
  >@if($value){{ $value }}@elseif(old($value)){{ old($value) }}@endif</textarea>
</div>