<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReponerVacas extends Model
{
    protected $fillable = [

        'user_id', 'dias_repuestos', 'motivo'
    ];

    protected $table = "reponer_vacas";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
