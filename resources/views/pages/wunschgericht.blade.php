@extends("layouts.master")
@section("title", "Wunschgericht")

@section("navbar-list-items")
    @include("includes.navbar_list_items.startseite_li")
    @include("includes.navbar_list_items.gerichte_li")
    @include("includes.navbar_list_items.meineBewertungen_li")
    @include("includes.navbar_list_items.login_or_profile_li")
@endsection

@section("main-content")
    <div id="flex-container-wunschgericht" style="height: 100%">
            <div class="container">
                <div class="row">
                    <h1>Sie haben ein bestimmtes Gericht im Sinn, das Sie gerne auf unserer Speisekarte sehen würden?</h1>
                    <p>Teilen Sie uns Ihr Wunschgericht mit, und wir werden unser Bestes tun, um Ihren kulinarischen Vorstellungen nachzukommen. Füllen Sie das folgende Formular aus, um uns Ihre kulinarische Inspiration zu übermitteln.</p>
                </div>
                <hr class="fh-color">
                <div class="row">
                    <form method="post" action="/wunschgericht">
                        @csrf
                        <div class="form-group">
                            <label for="gericht">Wunschgericht: </label>
                            <input type="text" id="gericht" name="wunschgericht" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="beschreibung">Beschreibung: </label>
                            <textarea name="beschreibung" id="beschreibung" class="form-control" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Schicken</button>
                    </form>
                </div>
            </div>
    </div>
@endsection
