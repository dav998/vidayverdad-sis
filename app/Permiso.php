<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $fillable = [
        'fecha_ausencia', 'user_id', 'motivo', 'cargo', 'suplente', 'observaciones', 'aprobado', 'url', 'tipo'
    ];

    protected $table = "permisos";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function user(){
        return $this->belongsTo(User::class);
    }

}
