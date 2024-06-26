<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # To get all the posts of a user
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    # To get all the followers of a user
    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    # To get all the users that the user is following
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    # Returns true if the Auth user is already following the user
    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

    # Returns true if the user is following the Auth user
    public function isFollowingMe()
    {
        return $this->following()->where('following_id', Auth::user()->id)->exists();
    }
}
