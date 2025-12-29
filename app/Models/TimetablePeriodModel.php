<?php 

namespace App\Models;

use CodeIgniter\Model;

class TimetablePeriodModel extends Model
{
    protected $table = 'timetable_periods';
    protected $primaryKey = 'id';
    protected $allowedFields = ['period_number', 'start_time', 'end_time'];
}