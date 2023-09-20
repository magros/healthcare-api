<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeSchedule extends Model
{
    protected $fillable = ['weekday','end_hour','start_hour','office_id'];
}
