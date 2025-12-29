<?php

namespace App\Controllers;

use App\Models\StudentModel;

class AdminGraduatesController extends BaseController
{
    public function index()
    {
        $studentModel = new StudentModel();

        // Only graduated students
        $graduates = $studentModel
            ->where('status', 'graduated')
            ->findAll();

        return view('admin/graduates/index', [
            'graduates' => $graduates
        ]);
    }
}