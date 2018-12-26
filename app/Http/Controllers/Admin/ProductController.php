<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Validator;
use App\User;

class ProductController extends Controller
{
    
       public function __construct()
    {
        $this->middleware('auth');
    }


    public function createProductForm(Request $request)
    {
       $franchises = User::where('user_type','franchise')->get();
       return view('admin.product.createproduct', ['franchises' => $franchises]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'min_fee_allowed' => 'required|numeric',
            'max_fee_allowed' => 'required|numeric',
            'elc_share' => 'required|numeric',
            'min_fee_books_services' => 'required|numeric',
        ]);
    }

    public function createProduct(Request $request)
    {
        //echo "<pre>";
        $post_data = $request->all();
        $this->validator($post_data)->validate();
              $pid = $post_data['pid'];
              $pexp = explode('_',$pid);
             $post_data['pid']= $pexp[0];
             $post_data['product_name']= $pexp[1];
             //print_r($post_data);die;
        $product = Product::create($post_data);
        $request->session()->flash('success', 'Product Created Successfully.');
        return redirect("/dashboard");
    }
}
