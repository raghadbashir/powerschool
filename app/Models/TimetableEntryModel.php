<?php

namespace App\Models;

use CodeIgniter\Model;

class TimetableEntryModel extends Model
{
    protected $table      = 'timetable_entries';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    // ✅ IMPORTANT: include academic_year_id here
    protected $allowedFields = [
        'class_id',
        'period_id',
        'subject',
        'tcs_id',
        'teacher_id',
        'day',
        'academic_year_id'
    ];

    protected $useTimestamps = false;
}