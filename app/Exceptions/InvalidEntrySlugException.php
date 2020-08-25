<?php

namespace App\Exceptions;
use Exception;
use App\Entry;

//Se deja como indicador de la excepcion :)
class InvalidEntrySlugException extends Exception
{
    private $entry;

    //Se adiciona el constructor de la clase y se adiciona el parametro de la clase Entry :)
    public function __construct(Entry $entry, $massage = "", $code = 0, Throwable $previous = null){
        $this->entry = $entry;
        parent::__construct($massage, $code , $previous);
    }


    //Se realiza la construcción de un metodo para redireccionar :)
    public function render(){
        //Se redicciona a la ruta adecuada del objeto o entrada :)
        return redirect($this->entry->getUrl());
    }
}
