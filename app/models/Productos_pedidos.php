<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos_pedidos extends Model {
   
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'productos_pedidos';
    public $incrementing = true;
    public $timestamps = false;

    const DELETE_AT = 'deleted_at';

    protected $fillable = [
         'codigoPedido',
          'idProducto',
           'estadoProducto'
    ];
    
}