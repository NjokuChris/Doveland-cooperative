<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    public function Members()
    {
        return $this->belongsTo(Members::class, 'member_id', 'member_id');
    }

    public function Salary_group()
    {
        return $this->belongsTo(Loans_type::class, 'salary_group_id', 'salary_group_id');
    }
}
