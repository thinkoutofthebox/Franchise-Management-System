<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTransaction extends Model
{
    protected $table = 'student_transactions';

    protected $fillable = ['product_id', 'invoice_number', 'transaction_amount', 'payment_type', 'txnid', 'cheque_number', 'bank_name', 'branch_name', 'cheque_date'];

    
}
