<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = ['member_id','month_id','amount'];

    public function Members()
    {
        return $this->belongsTo(Members::class, 'member_id', 'member_id');
    }

    public function Months()
    {
        return $this->belongsTo(Months::class, 'month_id');
    }
}
