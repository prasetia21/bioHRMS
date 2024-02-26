<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPeringatan extends Model
{
    use HasFactory;

    public $table = 'surat_peringatans';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }

    public function teguran()
    {
        return $this->belongsTo(Teguran::class, 'teguran_id','id');
    }
}
