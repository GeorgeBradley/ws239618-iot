<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AjaxController;

class HomeController extends Controller
{
   public function index(){

    $data = AjaxController::dailyAverageTemperature();

            $result[] = ['Date/Time','Inside Temperature','Outside Temperature'];

        foreach ($data as $key => $value) {

            $result[++$key] = [$value->minTIMESTAMP, (int)$value->OutsideTemperature, (int)$value->InsideTemperature];

        }

  

        return view('index')

                ->with('visitor',json_encode($result));
   }
}
