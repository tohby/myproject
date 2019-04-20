<?php

namespace App;

use Rackbeat\UIAvatars\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasAvatar;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKey()
    {
        return $this->slug;
    }
    
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function question()
    {
        return $this->hasMany('App\Question');
    }

    public function getAvatar( $size = 64 ) {
      return $this->getGravatar( $this->email, $size );
    }
}
