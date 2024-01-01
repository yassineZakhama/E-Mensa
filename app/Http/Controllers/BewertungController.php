<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

include("../app/Models/bewertung.php");
class BewertungController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "sterne" => ["required", "integer", "min:1" ,"max:4"],
            "bemerkung" => ["required", "string", "min:6"]
        ]);

        $bemerkung = $request->input("bemerkung");
        $sterne = $request->input("sterne");
        $username = Auth::user()->name;
        $gericht_id = $request->input("gericht_id");
        db_bewertung_add_bewertung($bemerkung, $sterne, $username, $gericht_id);

        return redirect("/gerichte/" . $gericht_id);
    }

    public function destroy(Request $request, string $bewertung_id)
    {
        $gericht_id = $request->input("gericht_id");
        db_bewertung_loeschen($bewertung_id);

        return redirect("/gerichte/" . $gericht_id);
    }

    public function highlight(Request $request, string $bewertung_id)
    {
        $isHighlighted = $request->input("hervorgehoben") === "true";
        db_bewertung_hervorheben($bewertung_id, $isHighlighted);

        $gericht_id = $request->input("gericht_id");
        return redirect("/gerichte/" . $gericht_id);
    }

    public function show()
    {
        return view("pages.meinebewertungen", [
            "bewertungen" => db_bewertung_select_user_reviews(auth()->user()->id)
        ]);
    }
}
