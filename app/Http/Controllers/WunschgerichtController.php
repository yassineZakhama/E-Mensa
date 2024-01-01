<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

include("../app/Models/wunschgericht.php");

class WunschgerichtController extends Controller
{
    public function index()
    {
        return view("pages.wunschgericht");
    }

    public function store(Request $request)
    {
        $wunschgericht = $request->input("wunschgericht");
        $beschreibung = $request->input("beschreibung");
        $user = Auth::user()->name;

        wunsch_speichern($user, $wunschgericht, $beschreibung);

        return redirect("/wunschgericht");
    }
}
