<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'elc_products';

    protected $fillable = ['elc_id','pid','min_fee_allowed','max_fee_allowed','elc_share','min_fee_books_services','product_name'];
}
