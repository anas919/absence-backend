@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('page_update',$object->id) }}@else{{ route('page_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('page.title') }}</label>
            <input class="form-control" id="title" name="title" value="@if($object->id){{ $object->title }}@else{{ old('title') }}@endif" type="text" required="">
          </div>
      	</div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('page.link') }}</label>
            <input class="form-control" id="link" name="link" value="@if($object->id){{ $object->link }}@else{{ old('link') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('page.content') }}</label>
            <textarea class="form-control" id="content" name="content">@if($object->id){{ $object->content }}@else{{ old('content') }}@endif</textarea>
          </div>
        </div>
        
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection