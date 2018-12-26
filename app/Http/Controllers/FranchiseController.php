<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Product;
use Illuminate\Support\Facades\Validator;

class FranchiseController extends Controller
{
    public function requestBatchForm(Request $request)
    {
    	$user = $request->user();
    	$products = Product::where('elc_id', $user->id)->get();
    	return view('franchise.franchise.request_batch', ['products' => $products]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
			'batch_name'  => 'required|string|max:255',
			'batch_desc'  => 'required|string|max:255',
			'batch_start' => 'required|date_format:Y-m-d',
        ]);
    }

    public function requestBatch(Request $request)
    {
    	$post_data = $request->all();
    	$this->validator($post_data)->validate();
        $pid = $post_data['pid']; 
        $pexp = explode("_",$pid);
        $post_data['pid'] =$pexp[0];
        $post_data['product_name'] =$pexp[1];
    	$batch = Batch::create($post_data);
    	$request->session()->flash('success', 'Request submitted Successfully.');
    	return back();
    }

    public function batchList(Request $request)
    {
    	$user = $request->user();
        $products = Product::where('elc_id', $user->id)->get();
        return view('franchise.franchise.batch_list_main', ['products' => $products]);
    }

    public function loadbatchList(Request $request)
    {
    	$pid = $request->input('pid');
        $user = $request->user();
        $batches = Batch::where('elc_id', $user->id);
        if (!empty($pid)) {
            $batches = $batches->where('pid', $pid);
        }
        $batches = $batches->paginate(20);
        return view('franchise.franchise.batch_load_list', ['batches'=>$batches]);
    }
}
