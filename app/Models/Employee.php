<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function promotor_report(): HasOne
    {
        return $this->hasOne(PromotorReport::class);
    }

    public function sales_industri_report(): HasOne
    {
        return $this->hasOne(SalesIndustriReport::class);
    }

    public function sales_retail_report(): HasOne
    {
        return $this->hasOne(SalesRetailReport::class);
    }

    public function technician_report(): HasOne
    {
        return $this->hasOne(TechnicianReport::class);
    }

    public function admin_report(): HasOne
    {
        return $this->hasOne(AdminReport::class);
    }

    public function employee_report(): HasOne
    {
        return $this->hasOne(EmployeeReport::class);
    }

    public function leave(): HasOne
    {
        return $this->hasOne(Leave::class);
    }

    public function leave_request(): HasOne
    {
        return $this->hasOne(LeaveRequest::class);
    }

    public function present(): HasOne
    {
        return $this->hasOne(Present::class);
    }

    public function presence(): HasOne
    {
        return $this->hasOne(Presence::class);
    }

    
}
