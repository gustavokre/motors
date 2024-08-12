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
                'supplier_id' => $carObject->getSupplierId(),
                'external_car_id' => $carObject->getExternalCarId(),
            ],
            [
                'brand' => $carObject->getBrand(),
                'model' => $carObject->getModel(),
                'year' => $carObject->getYear(),
                'version' => $carObject->getVersion(),
                'color' => $carObject->getColor(),
                'km' => $carObject->getKm(),
                'fuel' => $carObject->getFuel(),
                'gear' => $carObject->getGear(),
                'doors' => $carObject->getDoors(),
                'price' => $carObject->getPrice(),
                'external_updated_at' => $carObject->getExternalUpdatedAt(),
            ]);

            if($car->exists) {
                //verifica se teve atualizacao no sistema do fornecedor
                if($car->external_updated_at !== $carObject->getExternalUpdatedAt()){
                    $car->save();
                }

            } else {
                $car->save();
            }

        }
    }
}
