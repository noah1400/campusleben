@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Alle veranstaltungen</h2>
            <hr>
        </div>
        <div class="col-md-10">
            @foreach (array_chunk($events->sortByDesc('id')->toArray(), 3, true) as $column)
            <div class="row">
                @foreach ($column as $event)
                    <div class="col-md-4 mt-3">
                        <div class="card" style="height:100%">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event['name'] }}</h5>
                                <p class="card-text">{{ strip_tags(Str::limit($event['description'], $limit = 90, $end = '...')) }}</p>
                                <a href="{{ route('events.show', ['id'=>$event['id']]) }}" class="btn btn-primary">Mehr anzeigen</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection