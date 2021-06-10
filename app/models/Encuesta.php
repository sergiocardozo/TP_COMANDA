<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model {
   
    protected $primaryKey = 'id';
    protected $table = 'encuestas';
    public $incrementing = true;
    public $timestamps = false;


    protected $fillable = [
        'puntosMesa', 'puntosMozo', 'puntosRestaurante', 'puntosCocinero', 'comentarios'
    ];
    
}