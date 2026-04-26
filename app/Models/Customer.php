<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable implements AuthenticatableInterface
{
    use Searchable;
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phoneNumber',
        'address',
        'profile_pic',
        'dob'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    public function toSearchableArray()
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email
        ];
    }




}
