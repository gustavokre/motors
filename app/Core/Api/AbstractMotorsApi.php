<?php


namespace App\Core\Api;

use App\Core\Car\CarSUpdate;
use Illuminate\Support\Facades\Log;

abstract class AbstractMotorsApi
{

    public function __construct(){}

    protected function updateCars(array $carsObjects) :bool {
        try {
            $carsUpdate = new CarSUpdate($carsObjects);
            $carsUpdate->update();
            return true;
        } catch (\Throwable $e) {
            Log::error("Erro durante a atualização de veículos por API erro: {$e->getMessage()}");
            return false;
        }
    }

    abstract protected function makeRequest() :bool;
    abstract public function getResponse() :?array;
    abstract public function start() :bool;

}
