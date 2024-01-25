<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRetailReport extends Model
{
    use HasFactory;

    public $table = 'sales_retail_reports';
    protected $guarded = [];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id','id');
    }

    public function employee()
    {
    	return $this->belongsTo(Employee::class, 'employee_id','id');
    }

    public function location()
    {
    	return $this->belongsTo(Location::class, 'location_id','id');
    }
}
