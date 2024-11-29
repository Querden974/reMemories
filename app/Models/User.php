<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory;

    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',

    ];


}
