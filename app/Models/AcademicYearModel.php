<?php

namespace App\Models;

use CodeIgniter\Model;

class AcademicYearModel extends Model
{
    protected $table = 'academic_years';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false; // keep false unless your table has updated_at
}