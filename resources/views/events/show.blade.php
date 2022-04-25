@extends("layouts.app")

@section("content")
<div class="container">
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
                            @if($event->pre_registration_enabled && $event->closed == false)
                            <p>Voranmeldungen: {{ $event->users->count() }} Max.: {{ $event->limit == 0 ? 'unbegrenzt' : $event->limit}}</p>
                            <p><a href="{{ route('events.attendShow',['event'=>$event->id])}}" class="btn btn-primary{{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' disabled' : ''}}" {{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' aria-disabled="true"' : ''}}>
                                    Anmelden
                                </a></p>
                            @elseif ($event->closed && $event->pre_registration_enabled)
                            <p>Anmeldungen abgelaufen</p>
                            @else
                                <p>Voranmeldungen: deaktiviert</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $event->preview_image) }}" alt="{{ $event->name }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection