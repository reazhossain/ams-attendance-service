<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table="checkinout";
    protected $fillable = ['is_pushed'];
}
