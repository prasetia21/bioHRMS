<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendNews extends Model
{
    use HasFactory;

    public $table = 'send_news';
    protected $guarded = [];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
