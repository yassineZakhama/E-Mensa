<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

include("../app/Models/gericht.php");
include("../app/Models/bewertung.php");
class MealsController extends Controller
{
    public function index()
    {
        return view("pages.gerichte", [
            "gerichte" => db_gericht_select_gerichte()
        ]);
    }

    public function show(string $gericht_id)
    {
        return view("pages.gericht", [
            "gericht" => db_gericht_select_gericht_detailed($gericht_id)[0],
            "bewertungen" => db_bewertung_select_all($gericht_id)
            ]
        );
    }


}
