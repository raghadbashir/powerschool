<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
    'student_id',
    'class_id',
    'teacher_id',
    'academic_year_id',
    'date',
    'status'
];
}