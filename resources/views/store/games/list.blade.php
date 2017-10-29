@foreach($games as $game)
  <div class="col-sm-3 game-wrapper">
    <div class="game">
      <h5 class="game-listing-title"><a class="game-link"
                                           href="{{ route('StoreGameShow', $game->slug) }}">{{ $game->name }}@if($game->new)
            <span class="label label-success">New</span> @endif</a></h5>
      <a href="{{ route('StoreGameShow', $game->slug) }}">
        <div class="game-img-wrapper"
             style="background: url({{ asset($game->image_thumb) }}) no-repeat center center; background-size:100% auto;"></div>
      </a>
      <h5 class="listing-price">@if($game->discounted_price)<span
          class="old-price">${{ $game->price }}</span> ${{ $game->discounted_price }} @else
          ${{ $game->price }} @endif</h5 class="listing-price">

      <form id="form-{{ $game->id }}" action="{{ route('StoreAddToCart') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="game_id" value="{{ $game->id }}">
      </form>
      <button class="btn add-cart" form="form-{{ $game->id }}"><span class="glyphicon glyphicon-shopping-cart"
                                                                        aria-hidden="true"></span> Add to cart
      </button>
    </div>
  </div>
@endforeach