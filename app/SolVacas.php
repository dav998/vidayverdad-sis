<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolVacas extends Model
{
    protected $fillable = [

        'tipo', 'user_id', 'fecha_inicio','fecha_fin', 'dias', 'observaciones', 'aprobado'
    ];

    protected $table = "solicitud_vacas";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
