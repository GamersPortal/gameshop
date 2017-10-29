@extends('store.master', ['title' => 'Cart'])

@section('main')

  <div class="panel panel-brand">
    <div class="panel-heading"><h3 class="panel-title text-center">Cart</h3></div>
    <table class="cart-content text-center">
      <thead>
      <tr>
        <th class="text-center">Name</th>
        <th class="text-center">Price</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Remove</th>
      </tr>
      </thead>
      <tbody>
      @foreach($cart->content() as $game)
        <tr>
          <td><a class="inherit"
                 href="{{ route('StoreGameShow', App\Models\Game::findOrFail($game->id)->slug) }}">{{ $game->name }}</a>
          </td>
          <td>${{ $game->price }}</td>
          <td>{{ $game->qty }}</td>
          <td>
            <form id="form-{{ $game->id }}" action="{{ route('StoreRemoveFromCart') }}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="rowId" value="{{ $game->rowid }}">
            </form>
            <button type="submit" class="btn btn-default" form="form-{{ $game->id }}"
                    aria-label="Remove game">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div class="panel-footer clearfix">
      <span class="total-price"><strong>Total: ${{ Cart::total() }}</strong></span>
		<span class="pull-right">
			<a href="{{ route('StoreCartCheckout') }}">
        <button class="btn btn-success">Proceed to checkout</button>
      </a>
			<a href="{{ route('StoreClearCart') }}">
        <button class="btn btn-danger">Clear cart</button>
      </a>
		</span>
    </div>
  </div>

@endsection