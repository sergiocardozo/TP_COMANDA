<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'usuarios';
    public $incrementing = true;
    public $timestamps = false;

    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'nombre', 'apellido', 'rol', 'clave', 'usuario', 'estadoEmpleado'
    ];   

    
}