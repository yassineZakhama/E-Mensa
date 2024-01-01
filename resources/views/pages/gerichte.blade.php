@extends("layouts.master")
@section("title", "Gerichte")

@section("navbar-list-items")
    @include("includes.navbar_list_items.startseite_li")
    @include("includes.navbar_list_items.wunschgericht_li")
    @include("includes.navbar_list_items.meineBewertungen_li")
    @include("includes.navbar_list_items.login_or_profile_li")
@endsection

@section("main-content")
    <div class="container">
        <div class="flex-container fh-color m-4">
            <h2>Köstlichkeiten, die Sie erwarten</h2>
        </div>

        @foreach($gerichte as $gericht)
            <div class="card mb-3">
                <img class="card-img-top" src="/img/gerichte/{{$gericht->bildname}}" alt="Card image cap" height="500px">
                <div class="card-body">
                    <h5 class="card-title">{{$gericht->name}}</h5>
                    <p class="card-text">{{$gericht->beschreibung}}</p>
                    <div class="flex-container">
                        <p class="card-text"><a href="/gerichte/{{$gericht->id}}" class="fh-color">{{$gericht->name}} ansehen</a></p>
                    </div>
                </div>
            </div>
        @endforeach

        @if(auth()->check())
            <h3 class="flex-container m-5">
            <a href="/wunschgericht" class="fh-color">Haben Sie eine präferierte Speiseempfehlung?</a>
            </h3>
        @endif
    </div>
@endsection
