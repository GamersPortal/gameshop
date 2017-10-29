@extends('admincp.master', ['title' => 'Admin panel - Games'])

@section('content')

  <form class="form-inline" method="GET" action="{{ route('AdminGameSearch') }}">
    <div class="form-group">
      <input name="q" type="text" class="form-control" placeholder="Search...">
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  <a class="btn btn-default btn-margin" href="{{ route('AdminGameCreate') }}" role="button">Create new game</a>

  <div class="categories">
    <table class="table table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>SKU</th>
        <th>Slug</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category slug</th>
      </tr>
      </thead>
      <tbody>
      @foreach($games as $game)
        <tr data-href="{{ route('AdminGameShow', $game->slug) }}">
          <td>{{ $game->id }}</td>
          <td>{{ $game->name }}</td>
          <td>{{ $game->sku }}</td>
          <td>{{ $game->slug }}</td>
          <td>${{ $game->price }}</td>
          <td>{{ $game->quantity }}</td>
          <td>@if($game->category) {{ $game->category->slug }} @endif</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  {!! $games->render() !!}

@endsection