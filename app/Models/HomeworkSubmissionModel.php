<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeworkSubmissionModel extends Model
{
    protected $table = 'homework_submissions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'homework_id',
        'student_id',
        'file_path',
        'submitted_at'
    ];
}