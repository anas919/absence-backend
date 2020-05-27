@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('semestre_update',$object->id) }}@else{{ route('semestre_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('semestre.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
      	</div>
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection