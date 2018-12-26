<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentReferredPhone extends Model
{
    protected $table = 'student_referred_phones';

    protected $fillable = [
					        'student_id', 'phone_number'
   						 ];

   	public function student()
    {
        return $this->belongsTo('App\FranchiseStudent', 'id', 'student_id');
    }
}
