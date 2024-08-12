<?php


namespace App\Core\Api;

use App\Core\Car\CarObject;
use App\Models\Supplier;
use Illuminate\Support\Facades\Http;

class WebMotorsApi extends AbstractMotorsApi
{
    private $response;
    private $supplier;

    const END_POINT = "https://run.mocky.io/v3/3f2cbb2d-4d0b-4742-8654-b65b1fdb2b87";

    public function __construct()
    {
        $this->supplier = Supplier::where('cnpj', '03347828000109')->first();
        if(!$this->supplier){
            throw new \Exception("Fornecedor não encontrado");
        }
    }

    public function start() :bool
    {
        if(!$this->makeRequest()){
            return false;
        }
        $cars = $this->createCarsObject();
        return $this->updateCars($cars);
    }

    private function createCarsObject() : array{
        $allCarsObject = [];
        foreach ($this->getResponse()['veiculos'] as $car) {

            $carObject = new CarObject();
            $carObject->setSupplierId($this->supplier->id);
            $carObject->setExternalId($car["id"]);
            $carObject->setBrand($car["marca"]);
            $carObject->setModel($car["modelo"]);
            $carObject->setYear($car["ano"]);
            $carObject->setVersion($car["versao"]);
            $carObject->setColor($car["cor"]);
            $carObject->setKm($car["km"]);
            $carObject->setFuel($car["combustivel"] ?? null);
            $carObject->setGear($car["cambio"]);
            $carObject->setDoors($car["portas"]);
            $carObject->setPrice($car["preco"]);
            $carObject->setExternalUpdatedAt($car["date"]);

            $allCarsObject[] = $carObject;

        }
        return $allCarsObject;
    }

    public function getResponse() :?array
    {
        return $this->response;
    }

    protected function makeRequest() :bool
    {
        $response = Http::get(self::END_POINT);

        if ($response->successful()) {
            $this->response = $response->json();
            return true;
        }
        $this->response = null;
        return false;
    }
}
