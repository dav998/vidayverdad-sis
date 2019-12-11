<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioUser extends Model
{
    protected $fillable = [

        'user_id', 'horario_id'
    ];

    protected $table = "horario_user";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
