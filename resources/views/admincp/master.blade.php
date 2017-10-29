@extends('admincp.primary-master')

@section('main')

  @include('admincp.navigation')
  <div class="container-fluid">
    <div class="row">
      @include('admincp.sidebar')
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @if(Session::has('status'))
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>{{ Session::get('status') }}
          </div>
        @endif
        @yield('content')
      </div>
    </div>
  </div>

@endsection