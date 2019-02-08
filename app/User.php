<?php

namespace App;

use App\Traits\CanVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Actuallymab\LaravelComment\CanComment;
use Lunaweb\EmailVerification\Contracts\CanVerifyEmail as CanVerifyEmailContract;

class User extends \TCG\Voyager\Models\User implements CanVerifyEmailContract
{
    use Notifiable;
    use CanComment;
    use CanVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function isAdmin() {
        return $this->isAdmin;
    }
}
