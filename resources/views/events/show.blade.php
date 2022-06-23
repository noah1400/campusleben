@extends("layouts.app")

@section("head")
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<script src="{{ asset('js/popups.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
@endsection

@section("body")
<div id="overlay" class="overlay"></div>
@endsection

@section("footer")

@endsection

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
                            <p>Voranmeldungen: {{ $event->users->count() }} Max.:
                                {{ $event->limit == 0 ? 'unbegrenzt' : $event->limit}}</p>
                            <p><a href="{{ route('events.attendShow',['event'=>$event->id])}}"
                                    class="btn btn-primary{{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' disabled' : ''}}"
                                    {{ $event->users->count() >= $event->limit && $event->limit != 0 ? ' aria-disabled="true"' : ''}}>
                                    Anmelden
                                </a></p>
                            @elseif ($event->closed && $event->pre_registration_enabled)
                            <p>Anmeldungen abgelaufen</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $event->preview_image) }}" alt="{{ $event->name }}"
                                class="img-fluid">
                        </div>
                    </div>
                    @admin
                    <div class="row">
                        <div class="col-md-12">
                            <div id="newPostButton" class="btn btn-primary"> New Post </div>
                        </div>
                    </div>
                    <!-- Create New Post Form -->
                    <div id="newPostForm" class="newPostForm">
                        <form id="createPostForm" action="{{ route('posts.newpost') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="event_id" value="{{ $event->id }}"></input>
                            @csrf
                            <div class="form-group">
                                <label for="subtitle">Untertitel</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle">
                            </div>
                            <div class="form-group mt-3">
                                <label for="picture">Bild</label>
                                <input type="file" class="form-control-file" id="picture" name="picture">
                            </div>
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="d-flex flex-row justify-content-between">
                                        <button type="submit" class="btn btn-primary">Posten</button>
                                        <button id="chancelNewPost" type="button" class="btn btn-secondary">Abbrechen</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endadmin

                    @if($post != null)
                    <div class="showPostOverlay"></div>
                        <div id="showPostPopup" class="showPostPopup">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/' . $post->picture) }}" alt="{{ $post->id }}"
                                        class="img-fluid w-100">
                                </div>
                                <div class="col-md-6 text-center">
                                    <p>{{ $post->subtitle}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($event->posts->count() > 0)
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="container">
                                <div id="posts">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    
                    <script>
                        var ENDPOINT = "{{ route('events.posts', ['event' => $event->id]) }}";
                        var PAGE = 1;

                        loadMore(PAGE);
                        $(window).scroll(function() {
                            if ($(window).scrollTop() + $(window).height() >= $(document).height()-1) {
                                PAGE++;
                                loadMore(PAGE);
                            }
                        })

                        function loadMore(page) {
                            $.ajax({
                                    url: ENDPOINT + '?page=' + page,
                                    datatype: "html",
                                    type: "get",
                                    beforeSend: function() {
                                        console.log("new posts loading");
                                    }
                                })
                                .done(function(response) {
                                    if (response.length == 0) {
                                        PAGE--;
                                        return;
                                    }
                                    $("#posts").append(response);
                                    feather.replace();
                                })
                                .fail(function(jqXHR, ajaxOptions, thrownError) {
                                    console.log("Error: " + jqXHR.status + " " + thrownError);
                                });
                        }
                    </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection