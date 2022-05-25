<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

     public function account_type()
    {
        return $this->belongsTo(account_type::class);
    }

    public function account_class()
    {
        return $this->belongsTo(account_class::class);
    }

    public function account_group()
    {
        return $this->belongsTo(account_group::class);
    }

    public function pay_method()
    {
        return $this->belongsTo(pay_method::class);
    }
}
