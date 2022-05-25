<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay_method extends Model
{
    use HasFactory;

    public function accounts()
    {
        return $this->hasMany(accounts::class);
    }
}
