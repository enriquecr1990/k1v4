<?php

namespace App\core;

class framework
{

    public $cargar;

    private $controlador;
    private $subdirectorio_ctrl;
    private $funcion;
    private $parametros;
    private $class_controller = null;

    const NAME_CONTROLLER = "\App\Controladores\\";

    function __construct(){
        $this->cargar = new Cargar();
        $this->controlador = 'welcome';
        $this->subdirectorio_ctrl = '';
        $this->funcion = 'index';
        $this->parametros = array();
        $this->procesar_peticion_url();
    }

    public function start(){
        require_once CONTROLADORES_PATH.$this->subdirectorio_ctrl.$this->controlador.'.php';
        $class = self::NAME_CONTROLLER.$this->controlador;
        $this->class_controller = new $class;
        if(!method_exists($this->class_controller,$this->funcion)){
            $this->pagina_no_encontrada();
        }
        call_user_func_array([$this->class_controller,$this->funcion],$this->parametros);
    }

    protected function procesar_peticion_url(){
        $url = '';
        if(isset($_GET['url']) && $_GET['url'] !== ''){
            $url = explode('/',$_GET['url']);
        }
        $peticion_url = verificar_peticion_url($url);
        if($peticion_url['validacion'] === false){
            //procesar la solicitud de una pagina no encontrada
            //include_once VISTAS_PATH.'default/404.php';
            $this->controlador = 'welcome';
            $this->funcion = 'error_404';
        }else{
            if($peticion_url['clase'] !== false){
                $this->controlador = $peticion_url['clase'];
            }if($peticion_url['funcion'] !== false){
                $this->funcion = $peticion_url['funcion'];
            }
            if(sizeof($peticion_url['directorios']) != 0){
                $this->subdirectorio_ctrl = implode('/',$peticion_url['directorios']);
                if(trim($this->subdirectorio_ctrl) != ''){
                    $this->subdirectorio_ctrl .= '/';
                }
            }
            if(sizeof($peticion_url['parametros']) != 0){
                $this->parametros = $peticion_url['parametros'];
            }
        }
    }

    protected function pagina_no_encontrada(){
        $this->controlador = 'welcome';
        $this->funcion = 'error_404';
        require_once CONTROLADORES_PATH.$this->controlador.'.php';
        $class = self::NAME_CONTROLLER.$this->controlador;
        $this->class_controller = new $class;
        $this->parametros = array();
    }

}