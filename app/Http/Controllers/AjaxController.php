<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
   public function index() {
   $insideTemperatureSQL = "
	 SELECT
    temperature_log.temperature,
    temperature_log.TIMESTAMP AS last_updated
    FROM temperature_log
    INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
    WHERE sensors.isInternal = 0

    ORDER BY temperature_log.TIMESTAMP
    LIMIT 1
   ";
   $outsideTemperatureSQL = "
   SELECT
   temperature_log.temperature,
   temperature_log.TIMESTAMP AS last_updated
   FROM temperature_log
   INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
   WHERE sensors.isInternal = 1

   ORDER BY temperature_log.TIMESTAMP
   LIMIT 1
   ";
$insideTemperature = DB::select(DB::raw($insideTemperatureSQL));

$outsideTemperature = DB::select(DB::raw($outsideTemperatureSQL));
return response()->json(array('insideTemperature'=> $insideTemperature, 'outsideTemperature' => $outsideTemperature), 200);
   }
}