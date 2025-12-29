<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeworkModel extends Model
{
    protected $table = 'homeworks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'class_id',
        'teacher_id',
        'subject',
        'title',
        'description',
        'due_date'
    ];
}