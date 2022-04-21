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
                    <p>Ort: {{ $event->location }}</p>
                    <p>Start: {{ $event->start_date }}</p>
                    <p>Ende: {{ $event->end_date }}</p>
                    <p>Beschreibung: <pre>{{ $event->description }}</pre></p>
                    <p>Voranmeldungen: {{ $event->users->count() }} Max.: {{ $event->limit == 0 ? 'unbegrenzt' : $event->limit}}</p>
                    <p><a href="{{ route('events.attendShow',['event'=>$event->id])}}" 
                          class="btn btn-primary{{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' disabled' : ''}}"
                          {{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' aria-disabled="true"' : ''}}>
                            Anmelden
                    </a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection