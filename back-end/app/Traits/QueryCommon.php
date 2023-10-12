<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait QueryCommon {
    public function tableQuery($table) {
        $query = DB::table($table);
        return $query;
    }

    /**
     * @return string
     */
    public function getTimestampQuery()
    {
        $times = now()->format('Y-m-d H:i:s');
        return $times;
    }
}
