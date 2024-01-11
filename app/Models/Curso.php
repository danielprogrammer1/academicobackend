<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $table = "cursos";
    protected $fillable = array('*'); // * significa que tiene todos los campos de la tabla cursos

    public function estudiantes(){
        return $this -> belongsToMany(Estudiante::class, 'curso_estudiante');
    } //(clase a la que se hace referencia y tabla intermedia en la db)
}

