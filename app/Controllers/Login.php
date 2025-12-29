<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Admin login view only
        return view('auth/login'); 
    }

    public function check()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = (new UserModel())
            ->where('username', $username)
            ->where('role', 'admin')
            ->first();

        if (!$user || $user['password'] !== $password) {
            return redirect()->back()->with('error', 'Invalid admin login');
        }

        session()->regenerate(true);

        session()->set([
            'logged_in' => true,
            'role'      => 'admin',
            'user_id'   => $user['id'],
        ]);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        $role = session()->get('role');

        session()->destroy();

        // Redirect to correct login page
        return match ($role) {
            'teacher' => redirect()->to('/teacher/login'),
            'student' => redirect()->to('/student/login'),
            'admin'   => redirect()->to('/login'),
            default   => redirect()->to('/choose-role'),
        };
    }
}