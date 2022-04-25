@extends("layouts.admin")

@section("content")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-outline-secondary">
                <span data-feather="plus-circle"></span>
                Neue Veranstaltung
            </a>
        </div>
    </div>
</div>
<h2>Alle Events</h2>
{{ $events->onEachSide(5)->links() }}
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Start</th>
                <th scope="col">Ende</th>
                <th scope="col">Standort</th>
                <th scope="col">Anmeldungen</th>
                <th scope="col">Max. Anmeldungen</th>
                <th scope="col">Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <th scope="row">{{ $event->id }}</th>
                <td>{{ $event->name }}</td>
                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d.m.Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d.m.Y') }}</td>
                <td>{{ $event->location }}</td>
                <td>
                    <a class="text-decoration-none" href="{{ route('admin.users') }}?event={{ $event->id }}">
                    {{ $event->users->count() }}
                    </a>
                </td>
                <td>{{ $event->limit }}</td>
                <td>
                    <div class="d-flex flex-row justify-content-between w-75">
                        <div>
                            <span type="button" data-toggle="modal" data-target="#deleteEvent-{{ $event->id }}" class="text-danger">
                                <span data-feather="trash-2"></span>
                            </span>
                        </div>
                        <div>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="text-warning">
                                <span data-feather="edit"></span>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('admin.events.show', $event->id) }}" class="text-info">
                                <span data-feather="eye"></span>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="deleteEvent-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-header" id="deleteEvent-{{ $event->id }}Label">Event löschen?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Möchtest du das Event wirklich löschen?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                    <form action="{{ route('admin.events.delete', ['id'=>$event->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Löschen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection