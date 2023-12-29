<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPermit extends Model
{
    use HasFactory;

    public $table = 'work_permits';
    protected $guarded = [];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
