<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
        'price',
    ];

    public function Prod_category()
    {
        $this->belongsTo(Product_category::class, 'category_id');
    }

}
