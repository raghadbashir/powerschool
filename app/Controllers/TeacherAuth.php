<?php

namespace App\Controllers;

use App\Models\UserModel;

class TeacherAuth extends BaseController
{
    public function login()
    {
        return view('auth/teacher_login');
    }

    public function authenticate()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = (new UserModel())
            ->where('email', $email)
            ->where('role', 'teacher')
            ->first();

        if (!$user || $user['password'] !== $password) {
            return redirect()->back()->with('error', 'Invalid teacher login');
        }

        $db = \Config\Database::connect();

        // teachers.email must match users.email
        $teacher = $db->table('teachers')
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Teacher profile not found in teachers table.');
        }


        session()->set([
            'logged_in'  => true,
            'role'       => 'teacher',
            'user_id'    => $user['id'],
            'teacher_id' => $teacher['id'],
        ]);

        return redirect()->to('/teacher/dashboard');
    }

   public function logout()
{
    session()->destroy();
    return redirect()->to('/choose-role');
}
}