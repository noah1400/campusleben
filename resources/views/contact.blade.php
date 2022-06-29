@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <h2>Kontakt</h2>
                <hr>
            </div>
            <div class="row">
            <p>CampusLeben ev. <br>
                    Kanalstraße 33<br>
                    73728 Esslingen am Neckar <br>
                </p>
                <p> <strong>Vertreten durch: </strong><br>
                    Tristan Eberhardt (zweiter Vorsitzender)<br>
                </p>
                <p><strong>Kontakt:</strong> <br>
                    Telefon: 0711 397-3498<br>
                    E-Mail: <a href='mailto:campusleben@hs-esslingen.de'>campusleben@hs-esslingen.de</a></br></p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span data-feather="instagram"></span>
                    <a class="h4 text-decoration-none" href="https://www.instagram.com/campus_leben/" target="_blank">@campus_leben</a>
                </div>
                <div class="col-md-12 pt-2">
                    <span data-feather="instagram"></span>
                    <a class="h4 text-decoration-none" href="https://www.instagram.com/cafeeinsteinhs/" target="_blank">@cafeeinsteinhs</a>
                </div>
                <div class="col-md-12">
                    <h3 class="pt-3 pb-2">Discord</h2>
                        <iframe src="https://discord.com/widget?id=953312705513680967&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script type="text/javascript">
    feather.replace()
</script>
@endsection