<?php


namespace App\Core\Car;

class CarObject
{
    private ?int $externalCarId;
    private ?int $supplierId;

    private ?string $brand;
    private ?string $model;
    private ?int $year;
    private ?string $version;
    private ?string $color;
    private ?int $km;
    private ?string $fuel;
    private ?string $gear;
    private ?int $doors;
    private ?float $price;
    private ?string $externalUpdatedAt;

    public function __construct(){

    }

    public function setSupplierId(int $supplierId): void
    {
        $this->supplierId = $supplierId;
    }

    public function setExternalId(int $externalCarId): void
    {
        $this->externalCarId = $externalCarId;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function setKm(?int $km): void
    {
        $this->km = $km;
    }

    public function setFuel(?string $fuel): void
    {
        $this->fuel = $fuel;
    }

    public function setGear(?string $gear): void
    {
        $this->gear = $gear;
    }

    public function setDoors(?int $doors): void
    {
        $this->doors = $doors;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setExternalUpdatedAt($externalUpdatedAt): void
    {
        $this->externalUpdatedAt = $externalUpdatedAt;
    }

    // --------------------------- GETTERS --------------------------------

    public function getExternalCarId(): ?int
    {
        return $this->externalCarId;
    }

    public function getSupplierId(): ?int
    {
        return $this->supplierId;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function getGear(): ?string
    {
        return $this->gear;
    }

    public function getDoors(): ?int
    {
        return $this->doors;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getExternalUpdatedAt(): ?string
    {
        return $this->externalUpdatedAt;
    }
}
