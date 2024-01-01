<?php
use Illuminate\Support\Facades\DB;

function db_users_select_anzahl_benutzer() {
    return DB::scalar("SELECT COUNT(*) FROM users");
}
