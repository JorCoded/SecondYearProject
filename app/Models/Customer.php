<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableInterface;

class Customer extends Authenticatable implements AuthenticatableInterface
{
    protected $table = 'customer';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phoneNumber',
        'address',
        'credCardNum',
        'profile_pic',
        'dob'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }
}
