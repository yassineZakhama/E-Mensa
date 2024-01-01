<?php

use Illuminate\Support\Facades\DB;

function wunsch_speichern($ersteller_name, $wunsch_name, $beschreibung)
{
    $ersteller_id = DB::scalar("SELECT id FROM users WHERE name = ?", [$ersteller_name]);

    $data = [
        "name" => $wunsch_name,
        "beschreibung" => $beschreibung,
        "erstellungsdatum" => date("Y-m-d"),
        "erstellt_von_userid" => $ersteller_id
    ];

    DB::table("wunschgericht")->insert($data);
}
