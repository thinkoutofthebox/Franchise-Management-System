<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentProduct extends Model
{
    protected $table = 'student_products';

    protected $fillable = [
					        'student_id','pid','batch_id', 'standard_fee', 'max_discount_amount', 'books_cost', 'discount_amount', 'total_amount', 'applicable_gst', 'net_due', 'amount_paid', 'balance_amount', 'last_fee_submission_date', 'is_fee_submitted'
   						 ];

   	public function transactions()
    {
        return $this->hasMany('App\StudentTransaction', 'product_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'pid', 'pid');
    }

    public function product_demos()
    {
        return $this->hasMany('App\ProductDemo', 'product_id', 'id');
    }
}
