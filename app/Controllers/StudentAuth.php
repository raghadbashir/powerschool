<?php

namespace App\Controllers;

use App\Models\UserModel;

class StudentAuth extends BaseController
{
    public function login()
    {
        return view('auth/student_login');
    }

    public function authenticate()
    {
        $studentNumber = $this->request->getPost('student_number');
        $password      = $this->request->getPost('password');

        // users.username = student_number
        $user = (new UserModel())
            ->where('username', $studentNumber)
            ->where('role', 'student')
            ->first();

        if (!$user || $user['password'] !== $password) {
            return redirect()->back()->with('error', 'Invalid student login');
        }

        $db = \Config\Database::connect();

        // students.student_number = users.username
        $student = $db->table('students')
            ->where('student_number', $studentNumber)
            ->get()
            ->getRowArray();

        if (!$student) {
            return redirect()->back()->with('error', 'Student profile not found in students table.');
        }


        session()->set([
            'logged_in'      => true,
            'role'           => 'student',
            'user_id'        => $user['id'],
            'student_id'     => $student['id'],
            'student_number' => $studentNumber,
        ]);

        return redirect()->to('/student/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/student/login');
    }
}