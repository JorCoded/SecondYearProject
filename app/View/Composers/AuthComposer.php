<?php

namespace App\View\Composers;

use App\Services\AuthService;
use Illuminate\View\View;

class AuthComposer
{
    protected $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function compose(View $view)
    {
        $view->with('currentUser', $this->authService->user());
        $view->with('userGuard', $this->authService->guard());
        $view->with('isCustomer', $this->authService->isCustomer());
        $view->with('isStaff', $this->authService->isStaff());
    }
}