@if (session()->has('success'))

  <notification
      message="{{ session()->get('success') }}"
      type="success"
  ></notification>

@elseif(session()->has('error'))

  <notification
      message="{{ session()->get('error') }}"
      type="error"
  ></notification>

@endif