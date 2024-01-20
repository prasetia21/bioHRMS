<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRule extends Model
{
    use HasFactory;

    public $table = 'leave_rules';
    protected $guarded = [];
}
