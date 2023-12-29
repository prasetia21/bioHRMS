<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotorReport extends Model
{
    use HasFactory;

    public $table = 'promotor_reports';
    protected $guarded = [];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function location()
    {
    	return $this->belongsTo(Location::class);
    }
}
