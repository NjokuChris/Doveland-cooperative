<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval_ProcessFlow extends Model
{
    protected $table = 'approval_process_flows';

    use HasFactory;

    public function ApprovalStage()
    {
        return $this->belongsTo(Approval_stages::class, 'approval_stage_id');
    }
    public function ProcessModule()
    {
        return $this->belongsTo(Approval_ProcessModules::class, 'process_module_id');
    }

    protected $fillable = ['process_module_id','approval_stage_id','process_no','active_id'];

}
