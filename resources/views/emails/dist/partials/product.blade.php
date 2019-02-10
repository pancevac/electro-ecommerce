<!--[if mso | IE]>
<table
    align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
>
  <tr>
    <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
<![endif]-->
<div style="background:white;background-color:white;Margin:0px auto;max-width:600px;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:white;background-color:white;width:100%;">
    <tbody>
    <tr>
      <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
        <!--[if mso | IE]>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">

          <tr>

            <td
                class="" style="vertical-align:top;width:300px;"
            >
        <![endif]-->
        <div class="mj-column-per-50 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
            <tr>
              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                  <tbody>
                  <tr>
                    <td style="width:200px;">
                      <a href="{{ $product->getUrl() }}">
                        <img height="auto" src="{{ $product->emailImage }}" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;" width="200" />
                      </a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </table>
        </div>
        <!--[if mso | IE]>
        </td>

        <td
            class="" style="vertical-align:top;width:300px;"
        >
        <![endif]-->
        <div class="mj-column-per-50 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
            <tbody>
            <tr>
              <td style="vertical-align:top;padding-top:40px;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="" width="100%">
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                      <div style="font-family:Roboto;font-size:16px;line-height:1;text-align:left;text-transform:uppercase;color:#000000;"> {{ __('emails.order_purchase.product.name') }}: <span class="span">{{ $product->get('name') }}</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                      <div style="font-family:Roboto;font-size:16px;line-height:1;text-align:left;text-transform:uppercase;color:#000000;"> {{ __('emails.order_purchase.product.code') }}:
                        <span class="span">{{ $product->code }}</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                      <div style="font-family:Roboto;font-size:16px;line-height:1;text-align:left;text-transform:uppercase;color:#000000;"> {{ __('emails.order_purchase.product.quantity') }}:
                        <span class="span">{{ $product->pivot->quantity }}</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                      <div style="font-family:Roboto;font-size:16px;line-height:1;text-align:left;text-transform:uppercase;color:#000000;"> {{ __('emails.order_purchase.product.price') }}:
                        <span class="span">{{ currency($product->pivot->price) }}</span>
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