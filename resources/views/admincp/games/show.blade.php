@extends('admincp.master', ['title' => 'Game - ' . $game->name])

@section('content')
  <div class="col-sm-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">
          <ol class="breadcrumb">
            @if($game->category)
              @foreach($game->category->getAncestorsAndSelf() as $parent)
                <li><a class="a-bread" href="{{ route('AdminCategoryShow', $parent) }}">{{ $parent->name }}</a></li>
              @endforeach
            @endif
            <span> --- {{ $game->name }}</span>
          </ol>
        </h3>
      </div>
      <div class="panel-body">
        <div class="buttons">
          <a class="btn btn-default" href="{{ route('AdminGameEdit', $game->slug) }}" role="button">Edit
            game</a>
          <a class="btn btn-default" href="{{ route('AdminGameDelete', $game->slug) }}" role="button">Delete
            game</a>
          @if($game->active)
            <a class="btn btn-default" href="{{ route('StoreGameShow', $game->slug) }}" role="button"
               target="_blank">Store page</a>
          @endif
        </div>

        <div class="col-sm-6 game-info">
          <h3>Game information</h3>
          <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $game->name }}</dd>

            <dt>Slug</dt>
            <dd>{{ $game->slug }}</dd>

            <dt>Price</dt>
            <dd>${{ $game->price }}</dd>

            <dt>Discounted price</dt>
            <dd>${{ $game->discounted_price }}</dd>

            <dt>Description</dt>
            <dd>{{ $game->description }}</dd>

            <dt>Name</dt>
            <dd>{{ $game->name }}</dd>

            <dt>SKU</dt>
            <dd>{{ $game->sku }}</dd>

            <dt>Quantity</dt>
            <dd>{{ $game->quantity }}</dd>

            <dt>Weight (kg)</dt>
            <dd>{{ $game->weight }}</dd>

            <dt>Is active</dt>
            <dd>{{ $game->active }}</dd>

            <dt>Is new</dt>
            <dd>{{ $game->new }}</dd>
          </dl>
        </div>

        <div class="col-sm-5  col-sm-offset-1">
          <img class="img-responsive" src="{{ asset($game->image) }}"></img>
        </div>
      </div>
    </div>
  </div>

@endsection