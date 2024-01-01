<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

include("../app/Models/gericht.php");
include("../app/Models/users.php");
include("../app/Models/bewertung.php");
class HomeController extends Controller
{
    public function index() : View {
        return view("pages.home", [
            "anzahl_gerichte" => db_gericht_select_anzahl_gerichte(),
            "anzahl_benutzer" => ((int)db_users_select_anzahl_benutzer()) - 1,
            "hervorgehobene_bewertungen" => db_bewertung_select_hervorgehobene()
        ]);
    }
}
