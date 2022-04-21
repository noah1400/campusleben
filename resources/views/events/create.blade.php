@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('events.store') }}">
            <div class="form-group">
                <label for="name">Name</label> 
                <input id="name" name="name" placeholder="z.B. Halloween Party" type="text" required="required" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Beschreibung</label> 
                <textarea id="description" name="description" cols="40" rows="5" class="form-control" required="required"></textarea>
            </div>
            <div class="form-group">
                <label for="location">Standort</label> 
                <input id="location" name="location" placeholder="z.B. Café Einstein" type="text" class="form-control" required="required">
            </div>
            <div class="form-group">
                <label for="start_date">Startdatum</label> 
                <input id="start_date" name="start_date" placeholder="tt/mm/jjjj" type="text" class="form-control" required="required">
            </div>
            <div class="form-group">
                <label for="end_date">Enddatum</label> 
                <input id="end_date" name="end_date" placeholder="tt/mm/jjjj" type="text" class="form-control" required="required">
            </div>
            @csrf
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection