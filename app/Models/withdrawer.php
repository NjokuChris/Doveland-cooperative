<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdrawer extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->hasOne(Members::class, 'member_id', 'member_id');
    }

    public function postedby()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function ApprovalStage()
    {
        return $this->belongsTo(Approval_stages::class, 'approval_stage_id');
    }
}
