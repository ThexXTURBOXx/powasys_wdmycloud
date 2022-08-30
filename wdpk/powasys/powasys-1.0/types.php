<?php

class Powador
{
    public $powadorId;
    public $name;
    public $color;

    function __construct($powadorId, $name, $color)
    {
        $this->powadorId = $powadorId;
        $this->name = $name;
        $this->color = $color;
    }
}
