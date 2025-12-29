<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = false; // If true, it won't delete

    protected $allowedFields = [
    'student_number',
    'name',
    'date_of_birth',
    'parent_id',
    'class_id',
    'created_at',
    'updated_at'
];
}