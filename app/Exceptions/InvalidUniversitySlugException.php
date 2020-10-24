<?php

namespace App\Exceptions;
use Exception;
use App\University;

//Se deja como indicador de la excepcion :)
class InvalidUniversitySlugException extends Exception
{
    private $university;

    //Se adiciona el constructor de la clase y se adiciona el parametro de la clase University :)
    public function __construct(University $university, $massage = "", $code = 0, Throwable $previous = null){
        $this->university = $university;
        parent::__construct($massage, $code , $previous);
    }


    //Se realiza la construcción de un metodo para redireccionar :)
    public function render(){
        //Se redicciona a la ruta adecuada del objeto o entrada :)
        return redirect($this->university->getUrl());
    }
}
