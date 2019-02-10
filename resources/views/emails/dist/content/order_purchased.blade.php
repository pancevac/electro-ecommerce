@extends('emails.dist.layout')

@section('content')
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
                <div
                    style="font-family:Roboto;font-size:13px;line-height:1;text-align:center;text-transform:uppercase;color:#000000;">
                  <h1> {{ __('emails.order_purchase.h1') }} </h1>
                </div>
              </td>
            </tr>
            <tr>
              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                <div style="font-family:Roboto;font-size:16px;line-height:1;text-align:center;color:#000000;"> {{ __('emails.order_purchase.h1_small') }}
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
      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;vertical-align:top;">
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
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:20px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:25px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.order_detail') }}:
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

@foreach($order->products as $product)

  @component('emails.dist.partials.product', [
    'product' => $product,
  ])
  @endcomponent()

@endforeach


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
      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;vertical-align:top;">
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
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.order_id') }}:
                  <span class="span"> {{ $order->id }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.purchased_date') }}:
                  <span class="span"> {{ $order->created_at }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.payment_method') }}:
                  <span class="span"> kartica</span>
                </div>
              </td>
            </tr>
            <tr>
              <td style="font-size:0px;word-break:break-word;">
                <!--[if mso | IE]>

                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="30" style="vertical-align:top;height:30px;">

                <![endif]-->
                <div style="height:30px;"> &nbsp;</div>
                <!--[if mso | IE]>

                </td></tr></table>

                <![endif]-->
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.customer.name') }}:
                  <span class="span"> {{ $order->billing_first_name }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.customer.surname') }}:
                  <span class="span"> {{ $order->billing_last_name }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.customer.email') }}:
                  <span class="span"> {{ $order->billing_email }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.customer.phone') }}:
                  <span class="span"> {{ $order->billing_phone }}</span>
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
      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;vertical-align:top;">
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
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:20px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:25px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.address.delivery_address') }}:
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
      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;vertical-align:top;">
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
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.address.address') }}:
                  <span class="span"> {{ $order->billing_address }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.address.city') }}:
                  <span class="span"> {{ $order->billing_city }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.address.postal_code') }}:
                  <span class="span"> {{ $order->billing_postalcode }}</span>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;word-break:break-word;">
                <div
                    style="font-family:Roboto;font-size:15px;font-weight:500;line-height:1;text-align:left;color:#000000;">
                  {{ __('emails.order_purchase.address.country') }}:
                  <span class="span"> {{ $order->billing_country }}</span>
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
              <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                <p style="border-top:solid 1px lightgrey;font-size:1;margin:0px auto;width:100%;">
                </p>
                <!--[if mso | IE]>
                <table
                    align="center" border="0" cellpadding="0" cellspacing="0"
                    style="border-top:solid 1px lightgrey;font-size:1;margin:0px auto;width:550px;" role="presentation"
                    width="550px"
                >
                  <tr>
                    <td style="height:0;line-height:0;">
                      &nbsp;
                    </td>
                  </tr>
                </table>
                <![endif]-->
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
      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:10px;text-align:center;vertical-align:top;">
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
              <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                <table cellpadding="0" cellspacing="0" width="100%" border="0"
                       style="cellspacing:0;color:#000000;font-family:Roboto;font-size:13px;line-height:22px;table-layout:auto;width:100%;">
                  <tr>
                    <td style="padding: 0 15px 0 0; font-size: 18px; line-height: 25px; text-align:left;">
                      {{ __('emails.order_purchase.subtotal_price') }}
                    </td>
                    <td style="padding: 0 15px; font-size: 18px; line-height: 25px; text-align:right;">{{ currency($order->billing_subtotal) }}</td>
                  </tr>
                  <tr>
                    <td style="padding: 0 15px 0 0; font-size: 18px; line-height: 25px; text-align:left;">
                      {{ __('emails.order_purchase.transport_and_delivery') }}
                    </td>
                    <td style="padding: 0 15px; font-size: 18px; line-height: 25px; text-align:right;">{{ currency(0) }}</td>
                  </tr>
                  <tr>
                    <td style="padding: 0 15px 0 0; font-size: 20px; font-weight: 500; line-height: 25px; text-align:left;">
                      {{ __('emails.order_purchase.total_price') }}
                    </td>
                    <td style="padding: 0 15px; font-size: 20px; font-weight: 500; line-height: 25px; text-align:right;">
                      {{ currency($order->billing_total) }}
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

@endsection