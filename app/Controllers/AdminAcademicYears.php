<?php

namespace App\Controllers;

use App\Models\AcademicYearModel;

class AdminAcademicYears extends BaseController
{
    public function index()
    {
        $model = new AcademicYearModel();

        return view('admin/academic_years/index', [
            'years' => $model->orderBy('start_date', 'DESC')->findAll()
        ]);
    }

    public function store()
    {
        $model = new AcademicYearModel();

        $model->insert([
            'name'       => $this->request->getPost('name'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date'   => $this->request->getPost('end_date'),
            'is_active'  => 0
        ]);

        return redirect()->back()->with('success', 'Academic year added');
    }

    public function activate($id)
    {
        $model = new AcademicYearModel();

        // ✅ SAFE: deactivate only currently active year
        $model->where('is_active', 1)
              ->set(['is_active' => 0])
              ->update();

        // ✅ Activate selected year
        $model->update($id, ['is_active' => 1]);

        // ✅ Store in session (used globally)
        session()->set('academic_year_id', $id);

        return redirect()->back()->with('success', 'Academic year activated');
    }
}