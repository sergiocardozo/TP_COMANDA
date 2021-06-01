<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'productos';
    public $incrementing = true;
    public $timestamps = false;

    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'descripcion', 'precio', 'rol'
    ];    
}