<?php

namespace App\Http\Controllers;

use App\Core\Api\RevendaMaisApi;
use App\Core\Api\WebMotorsApi;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public static function getAllCars(){
        return Car::all();
    }

    public function updateWebMotors(Request $request){
        $api = new WebMotorsApi();
        $done = $api->start();
        $status = $done ? 200 : 500;
        return response()->json(null, $status);
    }
    public function updateRendaMais(Request $request){
        $api = new RevendaMaisApi();
        $done = $api->start();
        $status = $done ? 200 : 500;
        return response()->json(null, $status);

    }
    public function truncateCars(Request $request){
        Car::truncate();
        return response()->json(['message' => 'Tabela resetada com sucesso.']);
    }

    public function reloadCars(Request $request){
        return response()->json(self::getAllCars());
    }
}
