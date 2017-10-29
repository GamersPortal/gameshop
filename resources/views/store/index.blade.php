@extends('store.master')

@section('main')

  @include('store.games.new-games')
  @include('store.games.discounted-games')

@endsection