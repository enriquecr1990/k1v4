<?php

function base_url(){
    $scheme = 'http://';
    if(isset($_SERVER['REQUEST_SCHEME'])){
        $scheme = $_SERVER['REQUEST_SCHEME'].'://';
    }
    $request = explode('/',$_SERVER['SCRIPT_NAME']);
    if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] != ''){
        $request[1] = $_SERVER['SERVER_NAME'];
    }
    $url = $scheme.$_SERVER['HTTP_HOST'].'/'.$request[1].'/';
    return $url;
}

function verificar_peticion_url($url){
    $data['validacion'] = true;
    $data['peticion_url'] = $url;
    $data['clase'] = false;
    $data['funcion'] = false;
    $data['estructura_url'] = array();
    $data['directorios'] = array();
    $data['parametros'] = array();
    $directorio_ctrls = CONTROLADORES_PATH;
    if(is_array($url)){
        foreach ($url as $index => $u){
            $subdirectorio = implode('/',$data['directorios']);
            if(trim($subdirectorio) != ''){
                $subdirectorio .= '/';
            }
            //primero verificamos que si es un directorio
            //caso contrario deberia ser un archivo para determinar la clase encontrada
            if(is_dir($directorio_ctrls.$subdirectorio.$u)){
                array_push($data['directorios'],$u);
            }else{
                if(!$data['clase'] && !$data['funcion']){
                    if(is_file($directorio_ctrls.$subdirectorio.$u.'.php')){
                        $data['clase'] = $u;
                    }
                }else{
                    if($data['clase'] && !$data['funcion']){
                        $data['funcion'] = $u;
                    }else{
                        if($data['clase'] && $data['funcion']){
                            $data['parametros'][] = $u;
                        }
                    }
                }
            }
        }
        if($data['clase'] === false){
            $data['validacion'] = false;
        }
    }
    return $data;
}

function cargar_arhivos_path($route){
    if(is_dir($route)){
        $directorio = dir($route);
        while($file = $directorio->read()){
            if($file != '.' && $file != '..'){
                if(is_dir($file)){
                    cargar_arhivos_path($file);
                }else{
                    require_once $route.$file;
                }
            }
        }
    }return true;
}
