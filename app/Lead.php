<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = [
					        'pid','product_name', 'name','email','phone','address','postal_code','father_name','image','category','is_muslim', 'ip'
   						 ];

}
