@extends("layouts.master")

@section("navbar-list-items")
    @include("includes.navbar_list_items.gerichte_li")
    @include("includes.navbar_list_items.wunschgericht_li")
    @include("includes.navbar_list_items.meineBewertungen_li")
    @include("includes.navbar_list_items.login_or_profile_li")
@endsection

@section("main-content")
    <img src="/img/fh_bjoern.jpg" class="img-fluid" alt="FH-Campus" width="100%">

    <div class="container p-5">
        <div class="row">
            <div class="col-11">
                <div class="container">
                    <div class="row">
                        <h1 class="display-4">Herzlich willkommen auf unserer Webseite!</h1>
                    </div>
                    <div class="row">
                        <section id="zahlen" class="col-md-6">
                            <h2 class="fh-color">Ihre E-Mensa in Zahlen</h2>

                            <ul>
                                <li>{{$anzahl_benutzer}} Benutzer</li>
                                <li>{{$anzahl_gerichte}} Speisen</li>
                            </ul>
                        </section>

                        <section id="wichtig" class="col-md-6">
                            <h2 class="fh-color">Das ist uns wichtig</h2>

                            <ul>
                                <li>Beste frische saisonale Zutaten</li>
                                <li>Ausgewogene abwechslungsreiche Gerichte</li>
                                <li>Sauberkeit</li>
                            </ul>
                        </section>

                    </div>
                </div>
            </div>
            <div class="col-1">
                <img src="/img/logo_fh.jpg" class="img-fluid" alt="FH-Logo" id="logo-fh">
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark text-light p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="img/mensa_fh.jpg" class="img-fluid" alt="fh_eup_campus">
                </div>
                <div class="col-md-8">
                   <div id="flex-container-home">
                       <h2>Vom Hörsaal in den Speisesaal</h2>
                       <p>Erfahren Sie was unsere Mensa zu bieten hat!</p>
                       <a href="/gerichte" class="fh-color">Speisen ansehen</a>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">
        <div class="flex-container">
            <h2 class="row mb-3 fh-color">Meinungen unserer Gäste</h2>
        </div>

        @foreach($hervorgehobene_bewertungen as $bewertung)
        <div class="card mb-3">
            <div class="card-header">
                {{$bewertung->name}}
            </div>
            <div class="card-body pt-0">
                <blockquote class="blockquote mb-0">
                    <p class="mb-0">
                        @for($i = 0; $i < 4; $i++)
                            <span style="font-size: 200%; color: #00857E;" class="p-0 m-0">
                                @if($i < $bewertung->sterne)
                                    &starf;
                                @else
                                    &star;
                                @endif
                            </span>
                        @endfor
                    </p>
                    <p>{{$bewertung->bemerkung}}.</p>
                    <footer class="blockquote-footer">{{$bewertung->ersteller}}</footer>
                </blockquote>
            </div>
        </div>
        @endforeach


    </div>

    <h3 id="welcome-message" class="display-5 p-5 fh-color">Wir freuen uns auf Ihren Besuch!</h3>


@endsection
