<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FranchiseInfo;
use App\FranchiseStudent;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        if (!$user->is_info_filled) {
           return view('franchise.dashboard.franchise_info');
        }
        $students = FranchiseStudent::where('user_id', $user->id)->get();
        return view('franchise.dashboard.dashboard', ['students'=>$students->count()]);
    }

    public function franchiseInfoForm(Request $request)
    {
    	if ($request->user()->is_info_filled) {
    		return redirect('/franchise');
    	}
    	return view('franchise.dashboard.franchise_info');
    }

    public function saveFranchiseInfo(Request $request)
    {
		$user      = $request->user();
		$post_data = $request->all();
    	
    	$save_data = [
						'user_id'           => $user->id,
						'is_existing_elc'   => $post_data['is_existing_elc'],
						'elc_running_years' => ($post_data['is_existing_elc']?$post_data['elc_running_years']:null),
						'is_premise_owned'  => $post_data['is_premise_owned'],
						'premise_area'      => $post_data['premise_area'],
						'franchise_profile' => $post_data['franchise_profile'],
						'investment_budget' => $post_data['investment_budget'],
						'courses'           => (isset($post_data['courses'])?json_encode($post_data['courses']):null),
						'days_req'          => $post_data['days_req'],
						'has_plan'          => (isset($post_data['has_plan'])?$post_data['has_plan']:1),
						'franchise_plan'    => (!isset($post_data['has_plan'])?$post_data['franchise_plan']:null),
    				];

    	// print_r($save_data);
    	$franchise_info = FranchiseInfo::create($save_data);
    	if (!is_null($franchise_info)) {
    		$user->is_info_filled = 1;
    		$user->save();
    	}

        $request->session()->flash('success', 'Your Info has been saved successfully.');
    	return redirect('/franchise');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return view('franchise.dashboard.profile', ['user' => $user]);
    }
}
