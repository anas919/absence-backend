@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('seance_update',$object->id) }}@else{{ route('seance_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('seance.date') }}</label>
            <input type="text" id="date" name="date" value="@if($object->id){{ $object->date }}@else{{ old('date') }}@endif" class="form-control" data-mask="yyyy-mm-dd hh:mm:ss" data-mask-clearifnotmatch="true" placeholder="yyyy-mm-dd hh:mm:ss" autocomplete="off" maxlength="19" required="">
          </div>
      	</div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('seance.prof') }}</label>
            <select class="form-control custom-select" name="prof">
              @if($profs && $object->prof)
                @foreach($profs as $prof)
                <option value="{{ $prof->id }}" @if($object->prof->id == $prof->id)selected="selected"@endif>{{ $prof->user->name }}</option>
                @endforeach
              @elseif($profs)
                @foreach($profs as $prof)
                <option value="{{ $prof->id }}">{{ $prof->user->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('seance.module') }}</label>
            <select class="form-control custom-select" name="module">
              @if($modules && $object->module)
                @foreach($modules as $module)
                <option value="{{ $module->id }}" @if($object->module->id == $module->id)selected="selected"@endif>{{ $module->name }}</option>
                @endforeach
              @elseif($modules)
                @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>
@endsection