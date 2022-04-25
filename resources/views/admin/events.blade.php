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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection