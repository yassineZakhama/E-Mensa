<?php

use Illuminate\Support\Facades\DB;
function db_gericht_select_gerichte() : array
{
    return DB::select("SELECT name, beschreibung, bildname, id FROM gericht ORDER BY name");
}

function db_gericht_select_gericht_detailed($id): array
{
    return DB::select("SELECT * FROM gericht WHERE id = ?", [$id]);
}
function db_gericht_select_anzahl_gerichte()
{
    return DB::scalar("SELECT COUNT(*) FROM gericht");
}
