@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Löschen aller Daten in Zusammenhang mit der E-Mail Adresse {{ auth()->user()->email }}.</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <p>Das Löschen deiner Daten kann nicht rückgängig gemacht werden!</p>
                        <p>Nach diesem Vorgang ist es dir nicht mehr möglich Events einzusehen an denen du teilgenommen hast!</p>
                        <p>Schau <a>hier</a> nach welche Daten wir gespeichert haben wenn du dir nicht sicher bist.</p>
                    </div>
                    <form action="{{ route('userdata.delete') }}" method="POST">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="delete_account" name="delete_account">
                            <label class="form-check-label" for="delete_account">
                                <span class="alert-danger">Meinen Account löschen (Auch dieser Vorgang kann nicht rückgängig gemacht werden!</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-danger">Ja, ich bin sicher!</button>
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">Nein, ich möchte zurück</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection