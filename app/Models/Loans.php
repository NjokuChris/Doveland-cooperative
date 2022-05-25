<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    public function loans_type()
    {
        return $this->belongsTo(loans_type::class, 'loan_type_id','salary_group_id');
    }

    public function period()
    {
        return $this->belongsTo(period::class);
    }

    public function loans_schedule()
    {
        return $this->hasMany(loans_schedule::class);
    }
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

    protected $fillable = ['member_id','loanamount','tenor','interest_rate','interestamount','monthlydeduction','total_payable_amount','loans_date','loan_type_id','paystartperiod_id','payendperiod_id','transID'];
}
