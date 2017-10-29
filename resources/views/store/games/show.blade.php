@extends('store.master', ['title' => $game->name])

@section('main')

  <div class="panel panel-brand">
    @include('store.categories.category-panel-heading', ['category' => $game->category])
    <div class="panel-body game-section">
      <div class="col-sm-4 text-center">
        <img class="img-responsive" src="{{ asset($game->image_thumb) }}"/>
      </div>
      <div class="col-sm-6">
        <h3 class="game-title">{{ $game->name }} @if($game->new) <span
            class="label label-success">New</span> @endif</h3>

        <p class="game-description">{!! $game->description !!}</p>
        <h4 class="listing-price">@if($game->discounted_price)<span
            class="old-price">${{ $game->price }}</span> ${{ $game->discounted_price }} @else
            ${{ $game->price }} @endif</h4 class="listing-price">

        <form id="form-{{ $game->id }}" action="{{ route('StoreAddToCart') }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="game_id" value="{{ $game->id }}">
        </form>
        <button class="btn btn-lg add-cart-big" form="form-{{ $game->id }}"><span
            class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to cart
        </button>
      </div>
    </div>
  </div>

@endsection