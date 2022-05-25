<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans_schedule extends Model
{
    use HasFactory;

    public function loans()
    {
        return $this->belongsTo(loans::class);
    }
}
