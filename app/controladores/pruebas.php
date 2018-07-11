<?php

namespace App\Controladores;

use App\core\controlador_base;

class pruebas extends controlador_base
{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        var_dump('aqui toy');
		var_dump($_SERVER);
		var_dump(base_url());
    }

    public function parametros($param_1 = false,$params_2 = false){
        var_dump($param_1,$params_2);
    }

}