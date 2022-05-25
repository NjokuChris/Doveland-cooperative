<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coop_process extends Model
{
    use HasFactory;

    protected $table = 'coop_process';
    protected $primaryKey = 'coop_processID';

    public function Payrollheaders()
    {
        return $this->belongsTo(Payrollheaders::class, 'payroll_id', 'payroll_id');
    }

    public function Users()
    {
        return $this->belongsTo(user::class, 'processed_by');
    }


}
