@extends("layouts.master")
@section("title", "Meine Bewertungen")

@section("navbar-list-items")
    @include("includes.navbar_list_items.startseite_li")
    @include("includes.navbar_list_items.gerichte_li")
    @include("includes.navbar_list_items.wunschgericht_li")
    @include("includes.navbar_list_items.login_or_profile_li")
@endsection

@section("main-content")
    <div class="container">
        <h1 class="flex-container fh-color m-5">Meine Bewertungen</h1>
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
                <h5 class="card-title">Gericht: <a href="/gerichte/{{$bewertung->gericht_id}}" class="fh-color">{{$bewertung->gericht_name}}</a></h5>
                <p class="card-text">Bewertung: {{$bewertung->bemerkung}}.</p>
                <form action="/bewertung/{{$bewertung->id}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" name="gericht_id" value="{{$bewertung->gericht_id}}">
                    <input type="submit" value="Löschen" class="btn btn-danger">
                </form>
            </div>
        </div>



    @endforeach
    </div>
@endsection



