<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FranchiseInfo extends Model
{
    protected $table = 'franchise_info';

    protected $fillable = [
					        'user_id',
					        'is_existing_elc',
							'elc_running_years',
							'is_premise_owned',
							'premise_area',
							'franchise_profile',
							'investment_budget',
							'courses',
							'days_req',
							'has_plan',
							'franchise_plan',
   						 ];

   	public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
