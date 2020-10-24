<?php

namespace App\Exceptions;
use Exception;
use App\Semester;

//Se deja como indicador de la excepcion :)
class InvalidSemesterSlugException extends Exception
{
    private $semester;

    //Se adiciona el constructor de la clase y se adiciona el parametro de la clase Semester :)
    public function __construct(Semester $semester, $massage = "", $code = 0, Throwable $previous = null){
        $this->semester = $semester;
        parent::__construct($massage, $code , $previous);
    }


    //Se realiza la construcción de un metodo para redireccionar :)
    public function render(){
        //Se redicciona a la ruta adecuada del objeto o entrada :)
        return redirect($this->semester->getUrl());
    }
}
