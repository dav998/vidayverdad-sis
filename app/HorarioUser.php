<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioUser extends Model
{
    protected $fillable = [

        'user_id', 'horarios_id'
    ];

    protected $table = "horario_user";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";
}
