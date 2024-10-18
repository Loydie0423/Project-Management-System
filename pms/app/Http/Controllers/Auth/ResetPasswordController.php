<?php
namespace App\Http\Controllers\Auth;

class ResetPasswordController
{
    public function index()
    {
        return view('auth.send-reset-link');
    }

    public function passwordReset()
    {
        return view('auth.reset-password');
    }
}