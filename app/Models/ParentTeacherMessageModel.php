<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentTeacherMessageModel extends Model
{
    protected $table = 'parent_teacher_messages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'teacher_id',
        'parent_id',
        'student_id',
        'subject',
        'message',
        'reply'
    ];
}