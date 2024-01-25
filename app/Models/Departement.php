<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Departement extends Model
{
    use HasFactory;
    public $table = 'departements';
    protected $guarded = [];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'employee_id','id');
    }
}
