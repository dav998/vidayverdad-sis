<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacas extends Model
{
    protected $fillable = [

        'tipo', 'fecha_inicio','fecha_fin','dias'
    ];

    protected $table = "vacaciones";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";
}
