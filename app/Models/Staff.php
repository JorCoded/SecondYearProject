<?php

namespace App\Models;

use DateTime;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableInterface;
//use Illuminate\Notifications\Notifiable;


class Staff extends Authenticatable implements AuthenticatableInterface
{
    public static string $pattern = '$hr%';
    protected $table = 'staff';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phoneNumber',
        'address',
        'profile_pic',
        'dob',
        'is_admin'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }
}
