<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans_type extends Model
{
    use HasFactory;


    public function Loans()
    {
        return $this->hasMany(Loans::class);
    }
}
