<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDemo extends Model
{
    protected $table = 'product_demos';

    protected $fillable = [
					        'product_id', 'batch_id', 'demo_class_date',
   						 ];

   	public function student_product()
    {
        return $this->belongsTo('App\StudentProduct', 'id', 'product_id');
    }
}
