<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {

   public function getStatuses(){

      $query = "SELECT * FROM status WHERE status.status_id = 1";
      $statuses = DB::SELECT(DB::raw($query));
  
      return response()->json(array('statuses' => $statuses), 200);
   }


   public function insideOutsideTemperature() {
   $insideTemperatureSQL = "
   SELECT
   temperature_log.temperature,
   temperature_log.TIMESTAMP AS last_updated,
   (
       SELECT
       status.s_insideTemp
       FROM status
       WHERE status.status_id = 1
   ) AS s_insideTemp
   FROM temperature_log
   INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
   WHERE sensors.isInternal = 1

   ORDER BY temperature_log.TIMESTAMP DESC
   LIMIT 1
   ";
   $outsideTemperatureSQL = "
   SELECT
   temperature_log.temperature,
   temperature_log.TIMESTAMP AS last_updated,
   (
       SELECT
       status.s_outsideTemp
       FROM status
       WHERE status.status_id = 1
   ) AS s_outsideTemp
   FROM temperature_log
   INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
   WHERE sensors.isInternal = 0

   ORDER BY temperature_log.TIMESTAMP DESC
   LIMIT 1;
   ";


$insideTemperature = DB::select(DB::raw($insideTemperatureSQL));

$outsideTemperature = DB::select(DB::raw($outsideTemperatureSQL));
return response()->json(array('insideTemperature'=> $insideTemperature, 'outsideTemperature' => $outsideTemperature), 200);
   }

  
   public static function dailyAverageTemperature(){

      $query = "SELECT
      DATE_FORMAT(temperature_log.TIMESTAMP, '%Y-%m-%d %H:%i') AS minTIMESTAMP,
      ROUND((SUM(temperature_log.temperature) / COUNT(temperature_log.temperature))) AS InsideTemperature,
      
      (
          SELECT 
         ROUND((SUM(temperature_log.temperature) / COUNT(temperature_log.temperature)))
          FROM temperature_log
          INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
          WHERE sensors.isInternal = 0 AND DATE_FORMAT(temperature_log.TIMESTAMP, '%Y-%m-%d %H:%i') = minTIMESTAMP
          GROUP BY sensors.isInternal = 0, DATE_FORMAT(temperature_log.TIMESTAMP, '%Y-%m-%d %H:%i') 
          ORDER BY 'minTIMESTAMP' DESC) AS OutsideTemperature
      
      FROM temperature_log
      INNER JOIN sensors ON sensors.sensor_id = temperature_log.sensor_id
      WHERE temperature_log.TIMESTAMP > DATE_SUB(NOW(), INTERVAL 1 DAY) AND sensors.isInternal = 1
      GROUP BY sensors.isInternal = 1, DATE_FORMAT(temperature_log.TIMESTAMP, '%Y-%m-%d %H:%i')
      ORDER BY minTIMESTAMP ASC";
      $dailyAverageTemperature = DB::select(DB::raw($query));
   
      return $dailyAverageTemperature;

   }

   public function turnOnInsideTempStatus(){
      DB::update("UPDATE `status` SET `s_insideTemp` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function turnOffInsideTempStatus(){
      DB::update("UPDATE `status` SET `s_insideTemp` = '0' WHERE `status`.`status_id` = 1;");
   }

   public function turnOnOutsideTempStatus(){
      DB::update("UPDATE `status` SET `s_outsideTemp` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function turnOffOutsideTempStatus(){
      DB::update("UPDATE `status` SET `s_outsideTemp` = '0' WHERE `status`.`status_id` = 1;");
   }

   public function acOn(){
      DB::update("UPDATE `status` SET `s_ac` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function acOff(){
      DB::update("UPDATE `status` SET `s_ac` = '0' WHERE `status`.`status_id` = 1;");
   }


   public function openWindow(){
      DB::update("UPDATE `status` SET `s_window` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function closeWindow(){
      DB::update("UPDATE `status` SET `s_window` = '0' WHERE `status`.`status_id` = 1;");
   }
   public function heatingOn(){
      DB::update("UPDATE `status` SET `s_heating` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function heatingOff(){
      DB::update("UPDATE `status` SET `s_heating` = '0' WHERE `status`.`status_id` = 1;");
   }
   public function fanOn(){
      DB::update("UPDATE `status` SET `s_fan` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function fanOff(){
      DB::update("UPDATE `status` SET `s_fan` = '0' WHERE `status`.`status_id` = 1;");
   }

   public function automaticOn(){
      DB::update("UPDATE `status` SET `is_automatic` = '1' WHERE `status`.`status_id` = 1;");
   }
   public function automaticOff(){
      DB::update("UPDATE `status` SET `is_automatic` = '0' WHERE `status`.`status_id` = 1;");
   }
}

