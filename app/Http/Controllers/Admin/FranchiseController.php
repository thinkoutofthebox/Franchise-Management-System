<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;

class FranchiseController extends Controller
{
    public function franchiseList(Request $request)
    {
        return view('admin.franchise.list_main');
    }

    public function loadfranchiseList(Request $request)
    {
        $search = $request->input('search');
        $user = $request->user();
        $franchises = User::where('user_type', 'franchise')
                                        ->where(function($w) use ($search){
                                            $w->where('name','like', '%'.$search.'%')
                                            ->orwhere('email','like', '%'.$search.'%')
                                            ->orwhere('phone','like', '%'.$search.'%');
                                        })
                                        ->paginate(2);
        return view('admin.franchise.load_list', ['franchises'=>$franchises]);
    }

    public function franchiseDetails(Request $request, $id)
    {
        $franchise = User::where('user_type', 'franchise')
        					->where('id', $id)->get()->first();
        if (is_null($franchise)) {
        	$request->session()->flash('warning', 'No Franchise on Id '.$id);
        	return redirect('/dashboard');
        }

        return view('admin.franchise.franchise_details',['franchise' => $franchise]);
    }
    public function franchiseEditProfile(Request $request, $id)
    {

          $franchise_data = User::where('user_type', 'franchise')
                            ->where('id', $id)->get()->first();
      
        return view('admin.franchise.edit_franchise_profile', ['franchise_data' => $franchise_data]);
        //return view('admin.franchise.edit_franchise_profile');
    }


   
     protected function updateValidator(array $data)
        {
            return Validator::make($data, [
                'name'        => 'required|string|max:255',
                'address'     => 'required|min:10',
                'postal_code' => 'required|numeric|min:6',
                'email' => 'required|string|max:255',
            ]);
        }

    public function updateFranchiseDetails(Request $request)
    {
        $franchise = null;
        $post_data = $request->all();
        $this->updateValidator($post_data)->validate();
        if (isset($post_data['id'])) {
            $franchise              = User::find($post_data['id']);
            $franchise->name        = $post_data['name'];
            $franchise->email       = $post_data['email'];
            $franchise->address     = $post_data['address'];
            $franchise->postal_code = $post_data['postal_code'];
            $franchise->city = $post_data['city'];
            $franchise->state = $post_data['state'];
            $franchise->save();
        }
        $request->session()->flash('success', 'Profile updated Successfully.');
        return redirect('/franchise-details/'.$post_data['id']);
    }
}
