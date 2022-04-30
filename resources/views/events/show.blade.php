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
                            @endif
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $event->preview_image) }}" alt="{{ $event->name }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if($event->comments()->count() > 0)
                            <h5>Kommentare ({{ $event->comments()->count()}})</h5>
                            <div class="container">
                                <div id="comments">

                                </div>
                                <div class="auto-load text-center">
                                    <button class="btn btn-primary" onclick="clickLoadMore()" id="load-more">Mehr Kommentare laden</button>
                                </div>
                            </div>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                var ENDPOINT = "{{ route('events.comments', ['event' => $event->id]) }}";
                                var PAGE = 1;
                                loadMore(PAGE);

                                function clickLoadMore() {
                                    PAGE++;
                                    loadMore(PAGE);
                                }

                                function loadMore(page) {
                                    $.ajax({
                                            url: ENDPOINT + '?page=' + page,
                                            datatype: "html",
                                            type: "get",
                                            beforeSend: function() {
                                                $("#load-more").html("Lade...");
                                            }
                                        })
                                        .done(function(response) {
                                            if (response.length == 0) {
                                                $("#load-more").html("Keine weiteren Kommentare");
                                                return;
                                            }
                                            $("#load-more").html("Mehr Kommentare laden");
                                            $("#comments").append(response);
                                        })
                                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                                            console.log("Error: " + jqXHR.status + " " + thrownError);
                                        })
                                }
                            </script>
                            @else
                            <p>Keine Kommentare</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection