<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserInfoPublic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'birthdate',
        'profile_img',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function imageUrl(): string{
        if(isset($this->profile_img)){
            return Storage::disk('public')->url('/app/public/'.$this->profile_img);
        }else{
            return Storage::disk('public')->url('profile_img/default_avatar.webp');
        }

    }
}
