<?php

namespace App\Exceptions;
use Exception;
use App\Course;

//Se deja como indicador de la excepcion :)
class InvalidCourseSlugException extends Exception
{
    private $course;

    //Se adiciona el constructor de la clase y se adiciona el parametro de la clase Course :)
    public function __construct(Course $course, $massage = "", $code = 0, Throwable $previous = null){
        $this->course = $course;
        parent::__construct($massage, $code , $previous);
    }


    //Se realiza la construcción de un metodo para redireccionar :)
    public function render(){
        //Se redicciona a la ruta adecuada del objeto o entrada :)
        return redirect($this->course->getUrl());
    }
}
