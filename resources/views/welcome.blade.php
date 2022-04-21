@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Campus Leben</h1>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <p class="h4">Seit dem Jahr 2011 nimmt CampusLeben viele Aufgaben innerhalb der Hochschule mit und für die Studierenden nach dem Motto "Mit Freunden etwas bewegen" wahr. CampusLeben hat es sich zum primären Ziel gemacht, die Studierenden der Fachschaften einzelner Fakultäten miteinander zu vernetzen. Dies gelingt ihnen und ebnet den Weg für viele, zuvor unmögliche, Projekte an der Hochschule Esslingen.</p>
                    <p class="h4">Der studentische Verein betreibt an jedem Standort der Hochschule je ein Café und ein Lehrmittelreferat, welche von Studierenden eigenständig betreut und verwaltet werden. Damit auch das Studentische Leben nach den täglichen Vorlesungen nicht zu kurz kommt, veranstaltet CampusLeben mit den Studierenden aller Fachschaften Partys, Aktivitäten und kulturelle Events.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('storage/images/csm_logo_campusleben.png') }}" alt="Campus Leben" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection