<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   /// protected $table="checkinout";
    protected $table="iclock_transaction";
    protected $fillable = ['is_pushed'];
}
