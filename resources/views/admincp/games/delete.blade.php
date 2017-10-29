@extends('admincp.master', ['title' => 'Are you sure?'])

@section('content')
  <div class="col-sm-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">
          {{ $game->name . ' ('. $game->slug . ')'}}
        </h3>
      </div>
      <div class="panel-body">
        <div class="alert alert-danger" role="alert">Are you sure you want to delete this game?</div>
        {!! Form::model($game, ['method' => 'DELETE', 'url' => route('AdminGameDestroy', $game->slug)]) !!}
        {!! Form::submit('Yes, delete game', ['class' => 'btn btn-danger']) !!}
        <a class="btn btn-default" href="{{ route('AdminGameShow', $game->slug) }}" role="button">No, go back</a>
        {!! Form::close() !!}

      </div>
    </div>
  </div>

@endsection