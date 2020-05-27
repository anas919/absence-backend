@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('module_update',$object->id) }}@else{{ route('module_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
      	</div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.ref') }}</label>
            <input class="form-control" id="ref" name="ref" value="@if($object->id){{ $object->ref }}@else{{ old('ref') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.filiere') }}</label>
            <select class="form-control custom-select" name="filiere">
              @if($filieres && $object->filiere)
                @foreach($filieres as $filiere)
                <option value="{{ $filiere->id }}" @if($object->filiere->id == $filiere->id)selected="selected"@endif>{{ $filiere->name }} ({{ $filiere->type }})</option>
                @endforeach
              @elseif($filieres)
                @foreach($filieres as $filiere)
                <option value="{{ $filiere->id }}">{{ $filiere->name }} ({{ $filiere->type }})</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.semestre') }}</label>
            <select class="form-control custom-select" name="semestre">
              @if($semestres && $object->semestre)
                @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}" @if($object->semestre->id == $semestre->id)selected="selected"@endif>{{ $semestre->name }}</option>
                @endforeach
              @elseif($semestres)
                @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}">{{ $semestre->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('module.profs') }}</label>
            <select class="form-control" id="profs[]" name="profs[]" multiple="multiple">
              @foreach($profs as $prof)
                <option value="{{ $prof->id }}"@if(isset($prof->en)) selected="selected" @endif>{{ $prof->user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('module.description') }}</label>
            <textarea class="form-control" id="description" name="description">@if($object->id){{ $object->description }}@else{{ old('description') }}@endif</textarea>
          </div>
        </div>
        
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection