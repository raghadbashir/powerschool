<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TeacherModel;
use CodeIgniter\Controller;

class Signup extends Controller
{
    public function index()
    {
        return view('auth/signup');
    }

    public function submit()
    {
        $role       = $this->request->getPost('role');
        $identifier = $this->request->getPost('identifier'); 
        $password   = $this->request->getPost('password');

        $userModel    = new UserModel();
        $teacherModel = new TeacherModel();

        // ============================================================
        // 🚀 TEACHER SIGNUP
        // ============================================================
        if ($role === 'teacher') {

            $teacher = $teacherModel->where('email', $identifier)->first();

            if (!$teacher) {
                return redirect()->back()->with('error', 'Teacher email not found.');
            }

            $existingUser = $userModel->where('email', $identifier)->first();

            if ($existingUser) {

                if (!empty($existingUser['password'])) {
                    return redirect()->back()->with('error', 'Account already exists.');
                }

                $userModel->update($existingUser['id'], [
                    'password' => $password
                ]);

            } else {
                $userModel->insert([
                    'username' => $teacher['name'],
                    'email'    => $identifier,
                    'password' => $password,
                    'role'     => 'teacher'
                ]);
            }

            // ✅ FIXED REDIRECT
            return redirect()->to('/teacher/login')
                ->with('success', 'Teacher account created successfully.');
        }

        // ============================================================
        // 🚀 STUDENT SIGNUP
        // ============================================================
        if ($role === 'student') {

            $db = \Config\Database::connect();

            $student = $db->table('students')
                ->where('student_number', $identifier)
                ->get()
                ->getRowArray();

            if (!$student) {
                return redirect()->back()->with('error', 'Student ID not found.');
            }

            $existingUser = $userModel
                ->where('username', $identifier)
                ->where('role', 'student')
                ->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'Student already has an account.');
            }

            $userModel->insert([
                'username' => $identifier,   // student_number
                'email'    => null,
                'password' => $password,
                'role'     => 'student'
            ]);

            // ✅ FIXED REDIRECT
            return redirect()->to('/student/login')
                ->with('success', 'Student account created successfully.');
        }

        // ============================================================
        // 🚀 PARENT SIGNUP
        // ============================================================
        if ($role === 'parent') {

            $db = \Config\Database::connect();

            $parent = $db->table('parents')
                ->where('email', $identifier)
                ->get()
                ->getRowArray();

            if (!$parent) {
                return redirect()->back()->with('error', 'Parent email not found.');
            }

            $existingUser = $userModel
                ->where('email', $identifier)
                ->where('role', 'parent')
                ->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'Parent already has an account.');
            }

            $userModel->insert([
                'username' => $parent['name'],
                'email'    => $identifier,
                'password' => $password,
                'role'     => 'parent'
            ]);

            // ✅ FIXED REDIRECT
            return redirect()->to('/choose-role')
                ->with('success', 'Parent account created successfully.');
        }

        // ============================================================
        return redirect()->back()->with('error', 'Unsupported role.');
    }
}