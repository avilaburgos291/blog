<?php

namespace App\Exceptions;
//Se adiciona clase de la excepcion :)
use App\Exceptions\InvalidEntrySlugException;
use App\Exceptions\InvalidUniversitySlugException;
use App\Exceptions\InvalidCourseSlugException;
use App\Exceptions\InvalidSemesterSlugException;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //Se modifica el tratamiendo de las excepciones por defecto adicionando el tratamiento para la excepcion desarrollada :)
        if ($exception instanceof InvalidEntrySlugException ) {
            //Se crea funcionalidad para dirreccionar a la ruta correcta :)
            //Se hace uso de la creación de un metodo para direccionar la informacion :)
            return $exception->render();
        }
        //Se modifica el tratamiendo de las excepciones por defecto adicionando el tratamiento para la excepcion desarrollada :)
        if ($exception instanceof InvalidUniversitySlugException ) {
            return $exception->render();
        }
        //Se modifica el tratamiendo de las excepciones por defecto adicionando el tratamiento para la excepcion desarrollada :)
        if ($exception instanceof InvalidCourseSlugException ) {
            return $exception->render();
        }
        return parent::render($request, $exception);
        //Se modifica el tratamiendo de las excepciones por defecto adicionando el tratamiento para la excepcion desarrollada :)
        if ($exception instanceof InvalidSemesterSlugException ) {
            return $exception->render();
        }
        return parent::render($request, $exception);
    }
}
