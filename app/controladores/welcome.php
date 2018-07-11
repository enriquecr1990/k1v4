<?php

namespace App\Controladores;

use App\core\controlador_base;

class welcome extends controlador_base
{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->cargar->vista('index');
    }

    public function error_404(){
        $this->cargar->vista('default/404');
    }

}