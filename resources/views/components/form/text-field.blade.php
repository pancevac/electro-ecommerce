<div class="form-group @if(isset($customWrapperClass) && $customWrapperClass){{ $customWrapperClass }}@endif">

  @if(isset($label) && $label)
    <label for="{{ $id }}">{{ $label }}</label>
  @endif
  <input
      type="@if(isset($type) && $type){{ $type }}@else text @endif"
      class="input @if(isset($customInputClass) && $customInputClass){{ $customInputClass }}@endif"
      id="{{ $id }}"
      name="{{ $name }}"
      placeholder="{{ $placeholder ? $placeholder  : '' }}"
      value="@if(isset($value) && $value){{ $value }}@elseif(old($name)){{ old($name) }}@endif"
      @if(isset($required) && $required) required @endif
      @if(isset($readonly) && $readonly) readonly @endif
      @if(isset($disabled) && $disabled) disabled @endif
  >
  {{--<div class="input-placeholder">
    {{ $placeholder }} @if (isset($required) && $required)<span>*</span>@endif
  </div>
  @if (isset($error_message) && $error_message != '')
    <span class="invalid-feedback">
      <strong>{{ $error_message }}</strong>
    </span>
  @endif--}}
</div>