<?php
namespace App\Models;

use CodeIgniter\Model;

class StudentEnrollmentModel extends Model
{
    protected $table = 'student_enrollments';
    protected $allowedFields = [
        'student_id',
        'class_id',
        'academic_year_id',
        'status',
        'created_at'
    ];
}