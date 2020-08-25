<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
//Se adiciona clase de entradas :)
use App\Entry;
//Se adiciona clase de la excepcion :)
use App\Exceptions\InvalidEntrySlugException;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //Configurando nuestro propio Routes ServiceProvider :)
        //Nuestro propio metodo de resolución de peticiones :)
        parent::boot();
        //se adiciona nombre de la varibale dada en la ruta para visitantes para evitar conflicto con las rutas internas de edición por lo cual se recibe con el nombre dado en la ruta como : entryBySlug.
        Route::bind('entryBySlug', function ($value) {
            //Se obtienen las partes de la ruta recibida para las entradas :)
            $parts = explode('-',$value);
            //Se obtiene el ultimo espacio en el vector  :)
            $id = end($parts);
            //Se intenta buscar una entrada en base al id obtenido :)
            //return Entry::findOrFail($id);
            //Ahora si se encuentra el objeto buscado se obtinene la información del mismo :)
            $entry = Entry::findOrFail($id);
            //Se valida la información del parametro enviado frentre a la informacion del objeto :)
            if ($entry->slug.'-'.$entry->id === $value) {
                return $entry;
            }else{
                //Encaso de coincidir la ruta seleccionada :)
                //Creamos una prueba frente a la excepcion :)
                //throw new Exception("Error Processing Request", 1);
                //Entonces se pasa como parametro el objeto de la clase encontrada :)
                throw new InvalidEntrySlugException($entry);
            }

            //Este seria el metodo por defecto :)
            //return Entry::where('name', $value)->firstOrFail();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
