<?php

namespace App\Model;

class Calculation
{
    /**
     * @var string
     */
    private string $operation;

    public function getOperation(): string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): Calculation
    {
        $this->operation = $operation;
        return $this;
    }

}