<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public $table = 'news';
    protected $guarded = [];

    public function employee()
    {
    	return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function getRouteKeyName()
    {
    return 'link';
    }
}
