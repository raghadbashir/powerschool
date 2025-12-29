<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ParentModel;

class ParentAuth extends BaseController
{
    public function loginForm()
    {
        return view('auth/parent_login');
    }

    public function attemptLogin()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $userModel   = new \App\Models\UserModel();
    $parentModel = new \App\Models\ParentModel();

    // 1️⃣ Find user
    $user = $userModel
        ->where('username', $username)
        ->where('role', 'parent')
        ->first();

    if (!$user || $user['password'] !== $password) {
        return redirect()->back()->with('error', 'Invalid login details');
    }

    // 2️⃣ Find parent profile using user_id
    $parent = $parentModel
        ->where('user_id', $user['id'])
        ->first();

    if (!$parent) {
        return redirect()->back()->with('error', 'Parent profile not found');
    }

    // 3️⃣ Store session
    session()->set([
        'parent_id'        => $parent['id'],   // parents.id
        'parent_user_id'   => $user['id'],     // users.id
        'role'             => 'parent',
        'parent_logged_in' => true
    ]);

    return redirect()->to('/parent/dashboard');
}
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/parent/login');
    }
}