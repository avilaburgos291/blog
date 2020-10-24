<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Course extends Model
{
    public function user(){
		return $this->belongsTo(User::class);
    }
    
    public function university(){
		return $this->belongsTo(University::class);
	}

	//Mutator para obtener la información del slug que vamos a guardar en la factories :)
	public function setTitleAttribute($value){
		//Se asigna el valor por defecto del campo para el title :)
		$this->attributes['title'] = $value;
		//Para el slug se utiliza las funcionalidad del metodo Slug de la clase: use Illuminate\Support\Str;
		$this->attributes['slug'] = Str::slug($value);
		//Asi cuando se asigne un valor para la creación de una entrada en el campo title se obtendra en campo slug la información de la funcionalidad de Slug.
		//Para probar esta información se pueden hacer pruebas con Tinker  con el comando: php artisan tinker :)
	}

	//Metodo para realiza la busqueda por un campo determinado por nosotros :)
	/*public function getRouteKeyName(){
		return 'slug';
	}*/

	public function getUrl(){
		//Se devulve el resultado de la combinación del slug con el id :)
		return url("courses/$this->slug-$this->id");
	}
}
