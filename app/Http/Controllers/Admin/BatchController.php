<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Batch;
use Illuminate\Support\Facades\Validator;
use App\User;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function approveBatchForm(Request $request, $batch_id)
    {   
        $batch = Batch::find($batch_id);
        return view('admin.batch.approve', ['batch' => $batch]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'batch_desc' => 'required|string|max:255',
            'batch_name' => 'required|string|max:255',
            'batch_start' => 'required|string|max:255',
            'batch_end' => 'required|string|max:255',
            'batch_timing_start' => 'required|string|max:255',
            'batch_timing_end' => 'required|string|max:255',
            'batch_last_date_adm' => 'required|string|max:255',
        ]);
    }

    public function approveBatch(Request $request)
    {
        echo "<pre>";
        $post_data = $request->all();
        //print_r($post_data);
         //die;
        $batch=Batch::find($post_data['id']);
        $batch->batch_desc   =   $post_data['batch_desc'];
        $batch->batch_start  =   $post_data['batch_start'];
        $batch->batch_end    =   $post_data['batch_end'];
        $batch->batch_timing_start   =   $post_data['batch_timing_start'];
        $batch->batch_timing_end     =   $post_data['batch_timing_end'];
        $batch->batch_last_date_adm  =   $post_data['batch_last_date_adm'];
        $batch->status=   $post_data['status'];
        $this->validator($post_data)->validate();
        $batch->save();
        $request->session()->flash('success', 'Batch Created Successfully.');
        return redirect("/dashboard");
    }
    public function adminBatchList(Request $request)
    {
        $franchises = User::where('user_type', 'franchise')->where('is_approved', 1)->get();
        return view('admin.batch.admin_batch_main', ['franchises' => $franchises]);
    }

    public function adminLoadBatchList(Request $request)
    {
        $elc_id = $request->input('elc_id');
        $pid = $request->input('pid');
        $batches = Batch::where('elc_id', $elc_id)->where('pid', $pid)->paginate(20);
        return view('admin.batch.admin_batch_list', ['batches' => $batches]);
    }
}
