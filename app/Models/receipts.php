<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipts extends Model
{
    use HasFactory;

    protected $fillable = ['subaccountcode', 'amount_paid', 'account_no', 'method_pay', 'paid_by', 'naration', 'receipt_date'];

     public function pay_method()
    {
        return $this->belongsTo(Pay_method::class, 'method_pay');
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function Subaccount()
    {
        return $this->belongsTo(Subaccountcode::class, 'subaccountcode');
    }

    public function Posted_by()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
