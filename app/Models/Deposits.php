<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposits extends Model
{
    use HasFactory;

    public function Members()
    {
        return $this->BelongsTo(Members::class, 'member_id', 'member_id');
    }

    public function postedby()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
