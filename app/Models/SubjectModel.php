<?php

namespace App\Models;
use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'code'
    ];
}