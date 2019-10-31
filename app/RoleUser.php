<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable = [

        'user_id', 'role_id'
    ];

    protected $table = "role_user";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function users(){
        return $this->belongsToMany('App\User');
    }

}
