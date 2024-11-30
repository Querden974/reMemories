<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserInfoPublic;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    use  HasFactory;

    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfoPublic::class, 'user_id');
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
