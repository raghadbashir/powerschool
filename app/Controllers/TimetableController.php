<?php

namespace App\Controllers;

use App\Models\TimetableEntryModel;
use CodeIgniter\Controller;

class TimetableController extends Controller
{
    public function saveEntry()
    {
        $json = $this->request->getJSON(true);  // <- this is the fix

        $subject_id = $json['subject_id'];
        $teacher_id = $json['teacher_id'];
        $period_id  = $json['period_id'];
        $day        = $json['day'];
        $class_id   = $json['class_id'];

        $entryModel = new TimetableEntryModel();

        // Insert entry
        $entryModel->insert([
            'class_id'   => $class_id,
            'period_id'  => $period_id,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id,
            'day'        => $day,
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }
}