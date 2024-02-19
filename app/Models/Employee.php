<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'employees';
    protected $fillable = [
        'user_level_id',
        'position_id',
        'departement_id',
        'nip',
        'phone',
        'password',
        'photo',
        'fullname',
        'gender',
        'address',
        'birth_date',
        'birth_place',
        'start_work_date',
        'contact_date',
        'status',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function level(){
        return $this->belongsTo(UserLevel::class,'user_level_id','id');
    }
    
    public function departement()
    {
        return $this->belongsTo(Departement::class,'departement_id','id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class,'position_id','id');
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
        return $this->hasOne(GetLeave::class);
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
