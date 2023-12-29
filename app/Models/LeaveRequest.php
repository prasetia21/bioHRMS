<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    public $table = 'leave_requests';
    protected $guarded = [];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function leave()
    {
    	return $this->belongsTo(Leave::class);
    }
}
