@extends("layouts.app")




@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert-box warning">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>Info!</strong> Deine Teilnahme an diesem Event wird in Zusammenhang mit deiner E-Mail Adresse gespeichert.
                Du kannst alle Daten, die in Zusammenhang mit deiner E-Mail Adresse, gespeichert wurden, jederzeit 
                <a href="{{ route('userdata.showdata') }}">einlesen</a> 
                oder 
                <a href="{{ route('userdata.deletedata') }}">löschen.</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $event->name }}</h3>
                        </div>
                        <div class="card-body">
                            @if ($event->pre_registration_enabled && $event->closed == false)
                                @if ($event->users->count() >= $event->limit && $event->limit != 0)
                                    <p>Die maximale Teilnehmerzahl wurde erreicht.</p>
                                @else
                                <p>Möchtest du dich für dieses Event anmelden?</p>
                                <form action="{{ route('events.attend', ['event'=>$event]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Ja</button>
                                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Nein</a>
                                </form>
                                @endif
                            @elseif ($event->closed && $event->pre_registration_enabled == true)
                                <p>Anmeldung abgelaufen</p>
                                <a href="{{ route('events.index') }}" class="btn btn-secondary">Zurück</a>
                            @else
                                <p>Für dieses Event ist die Vor-Anmeldung deaktiviert.</p>
                                <a href="{{ route('events.index') }}" class="btn btn-secondary">Zurück</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection