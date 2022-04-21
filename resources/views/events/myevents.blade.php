@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Angemeldete Veranstaltungen</h2>
            <hr>
            @foreach ($events as $event)
                <p>
                    <a href="{{ route('events.show',['id'=>$event->id]) }}">{{ $event->name }}</a>
                    {{$event->start_date}} - {{$event->end_date}}
                </p>
            @endforeach
        </div>
    </div>
</div>
@endsection