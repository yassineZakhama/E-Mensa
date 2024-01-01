@extends("layouts.master")
@section("title", $gericht->name)

@section("navbar-list-items")
    @include("includes.navbar_list_items.startseite_li")
    @include("includes.navbar_list_items.gerichte_li")
    @include("includes.navbar_list_items.wunschgericht_li")
    @include("includes.navbar_list_items.meineBewertungen_li")
    @include("includes.navbar_list_items.login_or_profile_li")
@endsection

@section("main-content")

    <div class="container" style="height: 100%;">
        <div class="row" style="height: 100%; width: 100%">
            <div class="col-md-6">
                <div class="container" style="height: 100%; width: 100%">
                    <div class="row justify-content-center align-items-center" style="height: 100%; width: 100%">
                        <div class="card" style="width: 70%; height:80%">
                            <img class="card-img-top" src="/img/gerichte/{{$gericht->bildname}}" alt="Gericht-Bild" height="400px">
                            <div class="card-body">
                                <h5 class="card-title">{{$gericht->name}}</h5>
                                <p class="card-text">{{$gericht->beschreibung}}.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if($gericht->vegetarisch)
                                    <li class="list-group-item"><img src="/img/vegetarisch.png" alt="vegetarisch" width="35" height="35"> Vegetarisch</li>
                                @endif
                                @if($gericht->vegan)
                                    <li class="list-group-item"><img src="/img/vegan.png" alt="vegan" width="35" height="35"> Vegan</li>
                                @endif
                                <li class="list-group-item">{{$gericht->preis_intern}} € für interne</li>
                                <li class="list-group-item">{{$gericht->preis_extern}} € für externe</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="container" style="height: 100%">
                    <div class="row justify-content-center align-items-center" style="height: 100%; width: 100%">
                        <div>
                            <section id="bewertung-formular">
                                @if(auth()->check())
                                    <h2 class="flex-container fh-color">Gericht bewerten:</h2>

                                    <form action="/bewertung" method="POST">
                                        @csrf
                                        <div class="flex-container">
                                            <div class="form-group rating">
                                                <input type="radio" id="star4" name="sterne" value="4" /><label class = "full" for="star4"></label>
                                                <input type="radio" id="star3" name="sterne" value="3" /><label class = "full" for="star3"></label>
                                                <input type="radio" id="star2" name="sterne" value="2" /><label class = "full" for="star2"></label>
                                                <input type="radio" id="star1" name="sterne" value="1" /><label class = "full" for="star1"></label>
                                            </div>
                                        </div>
                                        @if($errors->has("sterne"))
                                            <div class="flex-container">
                                                <small class="form-text text-muted">
                                                    {{$errors->first("sterne")}}
                                                </small>
                                            </div>
                                        @endif
                                        <div class="form-group mt-0">
                                            <label for="bemerkung">Bemerkung:</label>
                                            <textarea name="bemerkung" id="bemerkung" class="form-control">{{old("bemerkung")}}</textarea>
                                            @if($errors->has("bemerkung"))
                                                <small class="form-text text-muted">
                                                    {{$errors->first("bemerkung")}}
                                                </small>
                                            @endif
                                        </div>

                                        <input type="hidden" name="gericht_id" value="{{$gericht->id}}">
                                        <div class="flex-container mt-3 mb-2">
                                            <input type="submit" value="Schicken" class="btn btn-success">
                                        </div>
                                    </form>
                                @else
                                    <div class="flex-container">
                                        <a href="/login" class="fh-color">Melden Sie sich an, um eine Bewertung hinterzulassen!</a>
                                    </div>
                                @endif
                            </section>

                            <section id="bewertung-toggler">
                                <div class="flex-container">
                                    <button id="bewertung-toggler-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Bewertungen ansehen</button>
                                </div>
                                <div class="offcanvas offcanvas-bottom grey-bg" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="height: 50vh">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title fh-color" id="offcanvasBottomLabel">Bewertungen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body small">
                                        @foreach($bewertungen as $bewertung)
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    @for($i = 0; $i < 4; $i++)
                                                        <span style="font-size: 200%; color: #00857E;" class="p-0 m-0">
                                                            @if($i < $bewertung->sterne)
                                                                &starf;
                                                            @else
                                                                &star;
                                                            @endif
                                                        </span>
                                                    @endfor
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="blockquote mb-0">
                                                        <p>Bewertung: {{$bewertung->bemerkung}}</p>
                                                        <footer class="blockquote-footer">{{$bewertung->bewertungsersteller}}</cite></footer>
                                                        @if(auth()->check())
                                                            <div class="flex-container">
                                                                <div class="m-1">
                                                                    <form action="/bewertung/{{$bewertung->id}}" method="POST">
                                                                        @csrf
                                                                        @method("DELETE")
                                                                        <input type="hidden" name="gericht_id" value="{{$gericht->id}}">
                                                                        <input type="submit" class="btn btn-danger" value="Löschen">
                                                                    </form>
                                                                </div>
                                                                @if(auth()->user()->admin)
                                                                    @if($bewertung->hervorgehoben)
                                                                        <div class="m-1">
                                                                            <form action="/bewertung/{{$bewertung->id}}" method="POST">
                                                                                @csrf
                                                                                @method("PUT")
                                                                                <input type="hidden" name="hervorgehoben" value="true">
                                                                                <input type="hidden" name="gericht_id" value="{{$gericht->id}}">
                                                                                <input type="submit" class="btn btn-primary" value="Hervorhebung abwählen">
                                                                            </form>
                                                                        </div>
                                                                    @else
                                                                        <div class="m-1">
                                                                            <form action="/bewertung/{{$bewertung->id}}" method="POST">
                                                                                @csrf
                                                                                @method("PUT")
                                                                                <input type="hidden" name="hervorgehoben" value="false">
                                                                                <input type="hidden" name="gericht_id" value="{{$gericht->id}}">
                                                                                <input type="submit" class="btn btn-primary" value="Hervorheben">
                                                                            </form>
                                                                        </div >
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </blockquote>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
