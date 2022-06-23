@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Veranstaltung bearbeiten</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.events.update', ['id'=>$event->id]) }}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label> 
                <input id="name" name="name" placeholder="z.B. Halloween Party" type="text" required="required" class="form-control"
                        value="{{ $event->name }}">
            </div>
            <div class="form-group">
                <label for="description">Beschreibung</label> 
                <textarea id="description" name="description" cols="40" rows="5" class="form-control" required="required">
                    {{ $event->description }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="location">Standort</label> 
                <input id="location" name="location" placeholder="z.B. Café Einstein" type="text" class="form-control" required="required"
                        value="{{ $event->location }}">
            </div>
            <div class="form-group">
                <label for="start_date">Startdatum</label> 
                <input id="start_date" name="start_date" placeholder="tt.mm.jjjj" type="text" class="form-control" required="required"
                        value="{{ \Carbon\Carbon::parse($event->start_date)->format('d.m.Y') }}">
            </div>
            <div class="form-group">
                <label for="end_date">Enddatum</label> 
                <input id="end_date" name="end_date" placeholder="tt.mm.jjjj" type="text" class="form-control" required="required"
                        value="{{ \Carbon\Carbon::parse($event->start_date)->format('d.m.Y') }}">
            </div>
            <div class="form-group">
                <label for="limit">Max. Teilnehmer</label> 
                <input id="limit" name="limit" placeholder="0" type="text" class="form-control"
                        value="{{ $event->limit }}">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="pre_registration_enabled">Vor-Anmeldung aktivieren</label>
                <input id="pre_registration_enabled" name="pre_registration_enabled" type="checkbox" class="form-check-input" value=""
                        {{ $event->pre_registration_enabled == true ? 'checked' : '' }}>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="team_registration_enabled">Team-Anmeldung aktivieren (Noch nicht unterstützt)</label>
                <input id="team_registration_enabled" name="team_registration_enabled" type="checkbox" class="form-check-input" value="" disabled>
            </div>
            <div class="form-group">
                <label  for="preview_image">Vorschaubild</label>
                <input type="file" class="form-control @error('preview_image') is-invalid @enderror" id="preview_image" name="preview_image">
                @error('preview_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @csrf
            <div class="form-group mt-1">
                <button name="submit" type="submit" class="btn btn-primary">Speichern</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection