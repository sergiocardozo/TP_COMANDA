<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mesa extends Model
{  
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'mesas';
    public $incrementing = true;
    public $timestamps = false;

    const DELETE_AT = 'deleted_at';

    protected $fillable = [
        'codigoMesa', 'estadoMesa'
    ];    
}
