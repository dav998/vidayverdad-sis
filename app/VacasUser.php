<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacasUser extends Model
{
    protected $fillable = [

        'user_id', 'anos_trabajados','dias_totales', 'dias_disp'
    ];

    protected $table = "vacas_user";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function users(){
        return $this->belongsToMany('App\User');
    }

}
