@extends('emails.dist.layout')

@section('content')

  <!-- Naslov -->
  <!--[if mso | IE]>
  <table
      align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
  >
    <tr>
      <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
  <![endif]-->
  <div style="Margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
          <!--[if mso | IE]>
          <table role="presentation" border="0" cellpadding="0" cellspacing="0">

            <tr>

              <td
                  class="" style="vertical-align:top;width:600px;"
              >
          <![endif]-->
          <div class="mj-column-per-100 outlook-group-fix"
               style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
              <tbody>
              <tr>
                <td style="vertical-align:top;padding-top:50px;">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="" width="100%">
                    <tr>
                      <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div
                            style="font-family:Roboto;font-size:20px;line-height:1;text-align:center;text-transform:uppercase;color:#575759;">
                          {{ __('emails.verify_email.h1') }}
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!--[if mso | IE]>
          </td>

          </tr>

          </table>
          <![endif]-->
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <!--[if mso | IE]>
  </td>
  </tr>
  </table>
  <![endif]-->
  <!-- END Naslov -->
  <!-- BUTTON -->
  <!--[if mso | IE]>
  <table
      align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
  >
    <tr>
      <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
  <![endif]-->
  <div style="Margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
          <!--[if mso | IE]>
          <table role="presentation" border="0" cellpadding="0" cellspacing="0">

            <tr>

              <td
                  class="" style="vertical-align:top;width:600px;"
              >
          <![endif]-->
          <div class="mj-column-per-100 outlook-group-fix"
               style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;"
                   width="100%">
              <tr>
                <td align="center" vertical-align="middle"
                    style="font-size:0px;padding:10px 25px;word-break:break-word;">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                         style="border-collapse:separate;line-height:100%;">
                    <tr>
                      <td align="center" bgcolor="#D10024" role="presentation"
                          style="border:none;border-radius:50px;cursor:auto;padding:10px 25px;background:#D10024;"
                          valign="middle">
                        <a href="{{ $link }}"
                           style="background:#D10024;color:white;font-family:Roboto;font-size:13px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;"
                           target="_blank"> {{ __('emails.verify_email.button') }} </a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
          <!--[if mso | IE]>
          </td>

          </tr>

          </table>
          <![endif]-->
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <!--[if mso | IE]>
  </td>
  </tr>
  </table>
  <![endif]-->
  <!-- END BUTTON -->
  <!-- LINK -->
  <!--[if mso | IE]>
  <table
      align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
  >
    <tr>
      <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
  <![endif]-->
  <div style="Margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
      <tr>
        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
          <!--[if mso | IE]>
          <table role="presentation" border="0" cellpadding="0" cellspacing="0">

            <tr>

              <td
                  class="" style="vertical-align:top;width:600px;"
              >
          <![endif]-->
          <div class="mj-column-per-100 outlook-group-fix"
               style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;"
                   width="100%">
              <tr>
                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                  <div style="font-family:Roboto;font-size:13px;line-height:1;text-align:center;color:#000000;">
                    <p>
                      {!!  __('emails.verify_email.link', ['link' => $link]) !!}
                    </p>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <!--[if mso | IE]>
          </td>

          </tr>

          </table>
          <![endif]-->
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <!--[if mso | IE]>
  </td>
  </tr>
  </table>
  <![endif]-->
  <!-- END BUTTON -->

@endsection