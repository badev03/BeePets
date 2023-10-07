<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait QueryCommon {
    public function tableQuery($table) {
        $query = DB::table($table);
        return $query;
    }
}
