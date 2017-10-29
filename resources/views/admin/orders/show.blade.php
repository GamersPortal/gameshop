@extends('admin.master', ['title' => 'Order #' . $order->id])

@section('content')
  <div class="col-sm-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Order #{{ $order->id }}</h3>
      </div>
      <div class="panel-body">
        <div class="buttons">
          <a class="btn btn-default" href="{{ route('AdminOrderEdit', $order) }}" role="button">Change order status</a>
        </div>
        <div class="category-info">
          <h3>Order information</h3>
          <dl class="dl-horizontal">
            <dt>Customer</dt>
            <dd>#{{ $order->user->id }} {{ $order->user->name }}</dd>

            <dt>Order status</dt>
            <dd>{{ $order->status_code->name }}</dd>

            <dt>Order date and time</dt>
            <dd>&nbsp;</dd>

            <dt>Adddress</dt>
            <dd>&nbsp;</dd>
            <dt>Payment method</dt>
            <dd>&nbsp;</dd>

            <dt>Weight</dt>
            <dd>{{ $order->weight }}</dd>
          </dl>
        </div>

        <ul class="list-group">
          @foreach($order->products as $productItem)
            <a href="{{ route('AdminProductShow', $productItem->product->slug) }}" class="inherit">
              <li class="list-group-item">{{ $productItem->product->name }}, x{{ $productItem->quantity }},
                ${{ $productItem->price * $productItem->quantity }} </li>
            </a>
          @endforeach
          @if( $order->full_price < 150 - 15)
            <li class="list-group-item">Shipping (if order is under $150), $15</li>
          @endif
          <li class="list-group-item"><strong>Total: ${{ $order->full_price }}</strong></li>
        </ul>
      </div>
    </div>
  </div>

@endsection