<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'user_id', 'time'
    ];

    protected $table = "asistencia";
    //protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
