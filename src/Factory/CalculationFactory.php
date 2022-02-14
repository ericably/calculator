<?php

namespace App\Factory;

use App\Model\Calculation;

class CalculationFactory
{
    public function create(): Calculation
    {
        return new Calculation();
    }

}