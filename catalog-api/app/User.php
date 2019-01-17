<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

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


    public function categories(){
        return $this->hasMany(Category::class, 'owner_id'); 
    }

    public function products(){
        return $this->hasMany(Product::class, 'owner_id'); 
    }

    public function userVerification(){
        return $this->hasOne(UserVerification::class, 'user_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(){
        // return $this->roles()->where('label', 'ADM')->count() ? true : false;
        foreach ($this->roles()->get() as $role)
        {
            if ($role->label == 'ADM')
            {
                return true;
            }
        }

        return false;
    }

    public function isManager(){
        // return $this->roles()->where('label', 'MAN')->count() ? true : false;
        foreach ($this->roles()->get() as $role)
        {
            if ($role->label == 'MAN')
            {
                return true;
            }
        }

        return false;
    }
}
