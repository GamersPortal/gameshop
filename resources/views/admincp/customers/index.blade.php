@extends('admincp.master', ['title' => 'Admin panel - Customers'])

@section('content')



  <div class="categories">
    <table class="table table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Country</th>
        <th>Date registered</th>
      </tr>
      </thead>
      <tbody>
<tr><td>Empty table</td></tr>
      </tbody>
    </table>
  </div>
  {!! $customers->render() !!}

@endsection