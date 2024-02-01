<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReqWorkPermit extends Model
{
    use HasFactory, Prunable, SoftDeletes;
    public $table = 'req_work_permits';
    protected $guarded = [];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }

    public function present()
    {
        return $this->belongsTo(Present::class, 'present_id','id');
    }

    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subWeek());
    }
}
