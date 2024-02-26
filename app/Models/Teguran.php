<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teguran extends Model
{
    use HasFactory;

    public $table = 'tegurans';
    protected $guarded = [];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
