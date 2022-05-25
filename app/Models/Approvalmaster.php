<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvalmaster extends Model
{
    use HasFactory;

    public function ApprovalType()
    {
        return $this->belongsTo(approval_types::class, 'approval_type_id');
    }
    public function ApprovalStage()
    {
        return $this->belongsTo(Approval_stages::class, 'approval_stage_id');
    }
}
