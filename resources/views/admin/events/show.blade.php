@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $event->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Ort: {{ $event->location }}</p>
                            <p>Start: {{ $event->start_date }}</p>
                            <p>Ende: {{ $event->end_date }}</p>
                            <p>Beschreibung: {{ $event->description }}</p>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $event->preview_image) }}" alt="{{ $event->name }}" class="img-fluid">
                        </div>
                    </div>
                    @if ($event->limit != 0)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $event->users->count()/$event->limit*100 }}%" aria-valuenow="{{ $event->users->count() }}" aria-valuemin="0" aria-valuemax="{{ $event->limit }}">{{ $event->users->count()/$event->limit*100 }}%</div>
                            </div>    
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection