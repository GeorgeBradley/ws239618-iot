<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
   public function index() {
   $sqlQuery = "
	SELECT
    temperature_log.temperature,
    temperature_log.TIMESTAMP
    FROM temperature_log
    INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
    WHERE sensors.isInternal = 0

    ORDER BY temperature_log.TIMESTAMP
    LIMIT 1
";
$result = DB::select(DB::raw($sqlQuery));


return response()->json(array('msg'=> $result), 200);
   }
}