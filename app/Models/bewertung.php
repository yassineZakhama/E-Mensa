<?php

use Illuminate\Support\Facades\DB;

function db_bewertung_select_all($gericht_id)
{
    return DB::select("SELECT b.id, b.bemerkung, b.sterne, b.gericht_id, b.hervorgehoben,
       u.name AS bewertungsersteller FROM bewertung b
    JOIN users u ON b.erstellt_von_user_id = u.id
    WHERE b.gericht_id = ?", [$gericht_id]);
}

function db_bewertung_add_bewertung($bemerkung, $sterne, $username, $gericht_id)
{
    $ersteller_id = DB::scalar("SELECT id FROM users WHERE name = ?", [$username]);

    $data = [
        "bemerkung" => $bemerkung,
        "sterne" => $sterne,
        "bewertungszeitpunkt" => date('Y-m-d H:i:s'),
        "erstellt_von_user_id" => $ersteller_id,
        "gericht_id" => $gericht_id,
    ];

    DB::table("bewertung")->insert($data);
}

function db_bewertung_loeschen($bewertung_id)
{
    DB::table("bewertung")->where("id", "=", $bewertung_id)->delete();
}

function db_bewertung_hervorheben($bewertung_id, $isHighlighted)
{
    if($isHighlighted) {
        DB::update("UPDATE bewertung SET hervorgehoben = FALSE WHERE id = ?", [$bewertung_id]);
    } else {
        DB::update("UPDATE bewertung SET hervorgehoben = TRUE WHERE id = ?", [$bewertung_id]);
    }
}

function db_bewertung_select_hervorgehobene()
{
    return DB::select(
        "SELECT g.name, b.bemerkung, b.sterne, u.name AS ersteller FROM bewertung b
                    LEFT JOIN gericht g on b.gericht_id = g.id
                    LEFT JOIN users u on b.erstellt_von_user_id = u.id
                    WHERE hervorgehoben = TRUE;"
    );
}

function db_bewertung_select_user_reviews($user_id)
{
    return DB::select(
        "SELECT b.id, b.bemerkung, b.sterne, b.gericht_id, g.name AS gericht_name FROM bewertung b
                LEFT JOIN gericht g on b.gericht_id = g.id
                WHERE erstellt_von_user_id = ?
                ORDER BY bewertungszeitpunkt", [$user_id]);
}
