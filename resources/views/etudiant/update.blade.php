@extends('standard')

@section('content')
  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('etudiant_update',$object->id) }}@else{{ route('etudiant_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title"></h3>
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->user->getname() }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.role') }}</label>

            <select id="role" name="role" class="form-control select_with_filter">
              <option value="USER" @if($object->id && $object->user->getrole() == "USER" ) selected="selected" @endif >USER</option>
              <option value="ADMIN" @if($object->id && $object->user->getrole() == "ADMIN" ) selected="selected" @endif >ADMIN</option>
              <option value="PROF" @if($object->id && $object->user->getrole() == "PROF" ) selected="selected" @endif >PROF</option>
              <option value="ETUDIANT" @if($object->id && $object->user->getrole() == "ETUDIANT" ) selected="selected" @endif >ETUDIANT</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.email') }}</label>
            <input class="form-control" id="email" name="email" value="@if($object->id){{ $object->user->getemail() }}@else{{ old('email') }}@endif" type="email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.password') }}</label>
            <input class="form-control" id="password" name="password" value="" type="password">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.phone') }}</label>
            <input class="form-control" id="phone" name="phone" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudiant.cne') }}</label>
            <input class="form-control" id="cne" name="cne" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudiant.filiere') }}</label>
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
            <label class="form-label">{{ __('etudiant.date_inscription') }}</label>
            <input type="text" id="date" name="date" class="form-control" data-mask="yyyy-mm-dd hh:mm:ss" data-mask-clearifnotmatch="true" placeholder="yyyy-mm-dd hh:mm:ss" autocomplete="off" maxlength="19" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.avatar') }}</label>
            @if($object->id){!! $object->user->getavatar() !!}@endif
            <input class="form-contro" id="avatar" name="avatar" type="file">
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.groupes') }}</label>
            @php 
              $usergroupes = [];

              if($object->user and $object->user->groupes){
                foreach ($object->user->groupes as $ug) {
                  $usergroupes[$ug->id] = $ug->id;
                }
              }
            @endphp
            @foreach($groupes as $groupe)
              @php 
                if(in_array($groupe->id, $usergroupes))
                  $check_ = 'checked="checked"';
                else
                  $check_ = '';
              @endphp
              <div class="form-check checkbox_type">
                <input type="checkbox" {{ $check_ }} id="groupe{{$groupe->id}}" name="groupe[{{$groupe->id}}]" value="{{$groupe->id}}">
                <label for="groupe{{$groupe->id}}">{{$groupe->name}}</label>
              </div>
            @endforeach
          </div>
        </div>


      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection