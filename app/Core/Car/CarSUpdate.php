<?php


namespace App\Core\Car;

use App\Core\Car\CarObject;
use App\Models\Car;


class CarSUpdate
{
    private $cars;

    public function __construct(array $cars){
        $this->cars = $cars;
    }

    public function update(){
        foreach ($this->cars as $carObject) {
            if(!$carObject instanceof CarObject){
                continue;
            }

            $car = Car::firstOrNew([
                'external_car_id' => $carObject->getExternalCarId(),
            ]);

            if($car->exists) {
                //verifica se teve atualizacao no sistema do fornecedor.
                if($car->external_updated_at >= $carObject->getExternalUpdatedAt()){
                    continue;
                }
            }

            $car->supplier_id = $carObject->getSupplierId();
            $car->brand = $carObject->getBrand();
            $car->model = $carObject->getModel();
            $car->year = $carObject->getYear();
            $car->version = $carObject->getVersion();
            $car->color = $carObject->getColor();
            $car->km = $carObject->getKm();
            $car->fuel = $carObject->getFuel();
            $car->gear = $carObject->getGear();
            $car->doors = $carObject->getDoors();
            $car->price = $carObject->getPrice();
            $car->external_updated_at = $carObject->getExternalUpdatedAt();
            $car->save();
        }
    }
}
