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
                        @if($event->pre_registration_enabled)
                        <p>Voranmeldungen: {{ $event->users->count() }} Max.: {{ $event->limit == 0 ? 'unbegrenzt' : $event->limit}}</p>
                        <p><a href="{{ route('events.attendShow',['event'=>$event->id])}}" 
                            class="btn btn-primary{{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' disabled' : ''}}"
                            {{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' aria-disabled="true"' : ''}}>
                                Anmelden
                        </a></p>
                        @else
                            <p>Voranmeldungen: deaktiviert</p>
                        @endif
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $event->preview_image) }}" alt="{{ $event->name }}" class="img-fluid">
                        </div>
                    </div>
                    @if(Auth::check())
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Löschen
                        </button>

                        <!-- Modal -->
                        <div    class="modal fade" 
                                id="deleteModal" 
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="deleteModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-header" id="deleteModalLabel">Event löschen?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Möchtest du das Event wirklich löschen?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                        <form action="{{ route('events.delete', ['id'=>$event->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Löschen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('events.edit', ['id'=>$event->id]) }}" class="btn btn-warning">Bearbeiten</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection