<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

   public function authenticate()
{
    return redirect()->to('/login');
}
    public function logout()
{
    $role = session()->get('role');

    session()->destroy();

    return match ($role) {
        'teacher' => redirect()->to('/teacher/login'),
        'student' => redirect()->to('/student/login'),
        'admin'   => redirect()->to('/admin/login'),
        default   => redirect()->to('/')
    };
}
}