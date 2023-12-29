<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    public $table = 'presences';
    protected $guarded = [];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function present()
    {
        return $this->belongsTo(Present::class);
    }
}
