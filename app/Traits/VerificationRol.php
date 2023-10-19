<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait VerificationRol {

    public function verifiedPermissions(string $permission)
    {
        return Auth::user()->can($permission);
    }
}