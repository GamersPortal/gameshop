@if($errors->any())
  <div class="bg-danger alert text-danger col-sm-12">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif