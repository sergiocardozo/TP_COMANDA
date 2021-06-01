<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model {
   
    protected $primaryKey = 'id';
    protected $table = 'logs';
    public $incrementing = true;
    public $timestamps = false;


    protected $fillable = [
        'usuario', 'ruta', 'metodo', 'ip'
    ];
    
}