<?php
/**
 * Created by PhpStorm.
 * User: enriq
 * Date: 04/07/2018
 * Time: 05:10 PM
 */

namespace App\core;


class Cargar
{

    private $route_view;

    function __construct()
    {
        $this->route_view = VISTAS_PATH;
    }

    public function vista($str_route,$data = array()){
        if(strpos($str_route,'.php') === false){
            $str_route .= '.php';
        }
        include_once $this->route_view.$str_route;
    }

}