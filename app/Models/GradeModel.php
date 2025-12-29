<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'class_id',
        'academic_year_id',
        'subject',
        'teacher_id',
        'grade',
        'comment',
        'term',
        'midterm',
        'final',
        'total'
        
    ];
}