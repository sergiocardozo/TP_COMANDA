<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model {
   
    protected $primaryKey = 'id';
    protected $table = 'ventas';
    public $incrementing = true;
    public $timestamps = false;


    protected $fillable = [
        'codigoPedido', 'mesa', 'usuario', 'precioTotal'
    ];
    
}