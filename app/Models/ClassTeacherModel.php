<?php

namespace App\Models;
use CodeIgniter\Model;

class ClassTeacherModel extends Model
{
    protected $table = 'class_teacher';
    protected $primaryKey = 'id';
    protected $allowedFields = ['class_id', 'teacher_id'];
}