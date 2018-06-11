@component('mail::message')
# Order Shipped

Your order has been shipped!

**Order Email:** {{ $order->billing_email }}

**Order Name:** {{ $order->billing_first_name }}

**Order Total:** ${{ round($order->billing_total, 2) }}

**Items Ordered**

@foreach ($order->products as $product)
Name: {{ $product->name }} <br>
Price: ${{ round($product->pivot->price, 2)}} <br>
Quantity: {{ $product->pivot->quantity }} <br>
@endforeach

{{--@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])--}}
@auth
@component('mail::button', ['url' => route('user.order', ['id' => $order->id]), 'color' => 'green'])
View Order
@endcomponent
@endauth

Thanks,<br>
{{ config('app.name') }}
@endcomponent