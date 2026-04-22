<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected array $guards = ['customer', 'staff', 'web'];
    
    /**
     * Get the currently authenticated user from any guard
     */
    public function user()
    {
        foreach ($this->guards as $guard) {
            if ($user = Auth::guard($guard)->user()) {
                return $user;
            }
        }
        return null;
    }
    
    /**
     * Get the guard name for the currently authenticated user
     */
    public function guard(): ?string
    {
        foreach ($this->guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }
        return null;
    }
    
    /**
     * Check if user is of a specific type
     */
    public function isCustomer(): bool
    {
        return $this->guard() === 'customer';
    }
    
    public function isStaff(): bool
    {
        return $this->guard() === 'staff';
    }
    
    /**
     * Get the authenticated user ID
     */
    public function id()
    {
        return $this->user()?->id;
    }
    
    /**
     * Check if anyone is authenticated
     */
    public function check(): bool
    {
        return $this->user() !== null;
    }
}