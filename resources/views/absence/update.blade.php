@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('absence_update',$object->id) }}@else{{ route('absence_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('absence.etudiant') }}</label>
            <select class="form-control custom-select" name="etudiant">
              @if($etudiants && $object->etudiant)
                @foreach($etudiants as $etudiant)
                <option value="{{ $etudiant->id }}" @if($object->etudiant->id == $etudiant->id)selected="selected"@endif>{{ $etudiant->user->name }}</option>
                @endforeach
              @elseif($etudiants)
                @foreach($etudiants as $etudiant)
                <option value="{{ $etudiant->id }}">{{ $etudiant->user->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('absence.seance') }}</label>
            <select class="form-control custom-select" name="seance">
              @if($seances && $object->seance)
                @foreach($seances as $seance)
                <option value="{{ $seance->id }}" @if($object->seance->id == $seance->id)selected="selected"@endif>Séance de {{ $seance->module->name }} le {{ $seance->date }} ensigné par {{ $seance->prof->user->name }}</option>
                @endforeach
              @elseif($seances)
                @foreach($seances as $seance)
                <option value="{{ $seance->id }}">Séance de {{ $seance->module->name }} le {{ $seance->date }} ensigné par {{ $seance->prof->user->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('absence.justification') }}</label>
            <textarea rows="3" class="form-control" placeholder="{{ __('absence.justification') }}" id="date" name="justification">@if($object->id){{ $object->date }}@else{{ old('date') }}@endif</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('absence.fichier') }}</label>
            <!-- @if($object->id){!! $object->getavatar() !!}@endif -->
            <input class="form-contro" id="fichier" name="fichier" type="file">
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>
@endsection