<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }
}
