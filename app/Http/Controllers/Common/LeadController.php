<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Validator;
use App\Lead;

class LeadController extends Controller
{
    public function leadForm(Request $request)
    {
    	$products = Product::all();
    	return view('common.lead.lead_form', ['products' => $products]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
			'name'        => 'required|string|max:255',
			'email'       => 'required|string|email|max:255',
			'phone'       => 'required|numeric|digits:10',
			'address'     => 'required|min:10',
			'postal_code' => 'required|numeric|digits:6',
			'father_name' => 'required|string|max:255',
        ]);
    }

    public function saveLead(Request $request)
    {
    	$server = $request->server();
    	$post_data = $request->all();
    	$this->validator($post_data)->validate();
    	echo "<pre>";
    	$p = explode('_', $post_data['pid']);
    	$post_data['pid'] = $p[0];
    	$post_data['product_name'] = $p[1];
    	$post_data['is_muslim'] = isset($post_data['is_muslim'])?$post_data['is_muslim']:0;
    	$post_data['ip'] = $request->server('REMOTE_ADDR');
    	print_r($post_data);
    	$lead = Lead::create($post_data);
    	$request->session()->flash('success', 'Your Request is saved successfully.');
    	return back();
    }
}
