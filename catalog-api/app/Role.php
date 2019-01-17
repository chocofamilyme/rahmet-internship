<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static function client(){
        return Role::where('label', 'CLI')->first();
    }

    public static function manager(){
        return Role::where('label', 'MAN')->first();
    }

    public static function admin(){
        return Role::where('label', 'ADM')->first();
    }
}
