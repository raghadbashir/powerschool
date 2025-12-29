<?php

namespace App\Models;

use CodeIgniter\Model;



class ParentModel extends Model
{
    protected $table      = 'parents';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'parent_name',
        'email',
        'phone',
        'user_id'
    ];
}