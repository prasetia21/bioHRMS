<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use HasFactory, Prunable, SoftDeletes;

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

    public function present()
    {
    	return $this->belongsTo(Present::class);
    }

    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subWeek());
    }
}
