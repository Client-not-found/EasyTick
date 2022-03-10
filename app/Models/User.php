<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = ['key', 'groId', 'username', 'password', 
    'firstname', 'lastname', 'street', 'zip', 'city', 'state',
    'mail'];

    protected $primaryKey = 'key';

    public function getAuthPassword()
    {
        return $this->usePassword;
    }

}
