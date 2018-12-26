<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FranchiseStudent extends Model
{
    protected $table = 'franchise_student';

    protected $fillable = [
					        'user_id', 'name','email','phone','address','postal_code','father_name','image','category','is_muslim'
   						 ];

   	public function products()
    {
        return $this->hasMany('App\StudentProduct', 'student_id', 'id');
    }

    public function referred_phones()
    {
    	return $this->hasMany('App\StudentReferredPhone', 'student_id', 'id');
    }
}
