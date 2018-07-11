<?php
/**
 * Created by PhpStorm.
 * User: enriq
 * Date: 05/07/2018
 * Time: 06:38 PM
 */

namespace App\core;

class controlador_base
{

    public $cargar;

    function __construct()
    {
        $this->cargar = new Cargar();
    }

}