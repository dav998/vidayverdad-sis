<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function permisos(){
        return $this->belongsToMany('App\Permiso');
    }
    public function vacas(){
        return $this->belongsToMany('App\VacasUser');
    }
    public function solvacas(){
        return $this->belongsToMany('App\SolVacas');
    }

    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('nombre', $roles)->first();
    }
    public function hasAnyRole($role){
        return null !== $this->roles()->where('nombre', $role)->first();
    }

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }
}
