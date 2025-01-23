<?php namespace Project\Src\Models;

class Car 
{
    public $brand, $model, $year, $millage, $engineType, $gearboxType;

    function __construct(string $brand, string $model, int $year, float $millage, string $engineType, string $gearboxType)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->millage = $millage;
        $this->engineType = $engineType;
        $this->gearboxType = $gearboxType;
    }
}