<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    public function members()
    {
        $this->hasMany('App\Models\members');
    }

    protected $primaryKey = 'company_id';

    protected $fillable = [

        'company_name',
        'company_code',
    ];
}
