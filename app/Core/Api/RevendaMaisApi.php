<?php


namespace App\Core\Api;




use App\Core\Car\CarObject;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RevendaMaisApi extends AbstractMotorsApi
{
    private $response;
    private $supplier;

    const END_POINT = "https://run.mocky.io/v3/06c848b2-4123-4d7f-b761-38705df113c2"; //password: pass100

    public function __construct()
    {
        $this->supplier = Supplier::where('cnpj', '03995142000124')->first();
        if(!$this->supplier){
            throw new \Exception("Fornecedor não encontrado");
        }
    }

    protected function makeRequest(): bool
    {
        $response = Http::get(self::END_POINT);

        if ($response->successful()) {
            $this->response = $response->body();
            try {
                //Tenta carregar o XML e converter com json_encode e decode
                $this->response = simplexml_load_string($this->response);
                $this->response = json_encode($this->response);
                $this->response = json_decode($this->response);
                $this->response = $this->response->veiculos->veiculo;
                return true;

            } catch (\Throwable $e) {
                Log::error("Não foi possível fazer a conversao do XML erro: {$e->getMessage()}");
            }
        }
        $this->response = null;
        return false;
    }

    public function getResponse(): ?array
    {
        return $this->response;
    }

    private function createCarsObject(){
        $allCarsObject = [];
        foreach ($this->getResponse() as $car) {

            $carObject = new CarObject();
            $carObject->setSupplierId($this->supplier->id);
            $carObject->setExternalId($car->codigoVeiculo);
            $carObject->setBrand($car->marca);
            $carObject->setModel($car->modelo);
            $carObject->setYear($car->ano);
            $carObject->setVersion($car->versao);
            $carObject->setColor($car->cor);
            $carObject->setKm($car->quilometragem);
            $carObject->setFuel($car->tipoCombustivel ?? null);
            $carObject->setGear($car->cambio);
            $carObject->setDoors($car->portas);
            $carObject->setPrice($car->precoVenda);
            $carObject->setExternalUpdatedAt(Carbon::createFromFormat('d/m/Y H:i', $car->ultimaAtualizacao));

            $allCarsObject[] = $carObject;

        }
        return $allCarsObject;
    }

    public function start() :bool
    {
        if(!$this->makeRequest()){
            return false;
        }
        $cars = $this->createCarsObject();
        return $this->updateCars($cars);
    }
}
