<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    public function Company()
    {
     return $this->belongsTo(company::class, 'company_id','company_id');
    }

    public function branch_location()
    {
       return $this->belongsTo(branch_location::class, 'LocationID', 'id');
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'title');
    }

    public function bank()
    {
        return $this->belongsTo(Accounts::class, 'BankID');
    }

    protected $primaryKey = 'member_id';

    protected $casts = [
      'my_custom_datetime_field' => 'datetime'
  ];

    protected $fillable = [

       'member_no',
       'firstName',
       'middleName',
       'surName',
       'member_name',
       'savings_amount',
       'posted_date',
       'LocationID',
       'joined_date',
       'H_address',
       'email',
       'phoneNo',
       'is_staff',
       'employee_no',
       'company',
       'date_birth',
       'gender',
       'Home_location',
       'H_state',
       'BankID',
       'BankAcc_no',
       'photo',
       'posted_by',
       'title',
       'company_id'

    ];
}
