<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetLeave extends Model
{
    use HasFactory;

    public $table = 'get_leaves';
    protected $guarded = [];

    public function employee()
    {
    	return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
