@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Neue Veranstaltung</h1>
</div>
<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label> 
                <input id="name" name="name" placeholder="z.B. Halloween Party" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Beschreibung</label> 
                <textarea id="description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="location">Standort</label> 
                <input id="location" name="location" placeholder="z.B. Café Einstein" type="text" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_date">Startdatum</label> 
                <input id="start_date" name="start_date" placeholder="tt.mm.jjjj" type="text" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date">Enddatum</label> 
                <input id="end_date" name="end_date" placeholder="tt.mm.jjjj" type="text" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="limit">Max. Teilnehmer</label> 
                <input id="limit" name="limit" placeholder="0" type="text" class="form-control @error('limit') is-invalid @enderror" value="{{ old('email') }}">
                @error('limit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-check">
                <label for="pre_registration_enabled" class="form-check-label">Vor-Anmeldung aktivieren</label>
                <input id="pre_registration_enabled" name="pre_registration_enabled" type="checkbox" class="form-check-input" value="" checked>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="team_registration_enabled">Team-Anmeldung aktivieren (Noch nicht unterstützt)</label>
                <input id="team_registration_enabled" name="team_registration_enabled" type="checkbox" class="form-check-input" disabled>
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
                <button name="submit" type="submit" class="btn btn-primary">Erstellen</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection