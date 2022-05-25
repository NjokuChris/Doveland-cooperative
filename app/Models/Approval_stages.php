<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval_stages extends Model
{
    use HasFactory;

    protected $fillable = [

        'approval_stage',
        'process_type_id'

     ];

    public function Process_type()
    {
        return $this->belongsTo(Approval_process_type::class, 'process_type_id');
    }
}
