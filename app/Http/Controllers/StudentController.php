<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FranchiseStudent;
use Illuminate\Support\Facades\Validator;
use RobinCSamuel\LaravelMsg91\Facades\LaravelMsg91;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Batch;
use App\StudentTransaction;
use App\StudentProduct;
use App\StudentReferredPhone;
use App\ProductDemo;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeStudent;

class StudentController extends Controller
{
    const STUDENT_URLS = [
                            '/student-enquiry' => 'Student Enquiry', 
                            '/student-request-demo' => 'Request Demo Class',
                            '/student-registration-form' => 'Fee Receipt'
                        ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegistrationForm(Request $request)
    {
        if (!auth()->user()->is_approved) {
    		return redirect('/franchise');
    	}
    	return view('franchise.student.registration_main', ['heading' => self::STUDENT_URLS[$request->server('REQUEST_URI')]]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:franchise_student',
            'phone'       => 'required|numeric|digits:10|unique:franchise_student',
            'address'     => 'required|min:10',
            'postal_code' => 'required|numeric|digits:6',
            'father_name' => 'required|string|max:255',
            'image'       => 'required'
        ]);
    }

    protected function updateValidator(array $data)
    {
        return Validator::make($data, [
			'name'        => 'required|string|max:255',
			'address'     => 'required|min:10',
			'postal_code' => 'required|numeric|digits:6',
			'father_name' => 'required|string|max:255',
        ]);
    }

    public function checkRegisteredPhone(Request $request, $phone_number)
    {
        $user = $request->user();
        $student = FranchiseStudent::where('user_id', $user->id)
                                        ->where('phone', $phone_number)
                                        ->get()->first();
        if (is_null($student)) {
        	// $otp = rand(1001, 9999);
        	// $result = LaravelMsg91::sendOtp($phone_number, $otp, "Dear User, The verification code for registering with this mobile number is {$otp}");
            $products = Product::where('elc_id', $user->id)->get();
            return view('franchise.student.new_registration', ['products' => $products, 'phone'=> $phone_number]);
        } else {
            return view('franchise.student.existing_registration', ['student' => $student]);
        }
        
        return response()->json([$phone_number]);
    }

    public function registerStudent(Request $request)
    {
        $student = null;
    	$post_data = $request->all();
        $validator = $this->validator($post_data);
        // return response()->json($post_data);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
    	$referred_phone = $post_data['referred_phone'];
       
        DB::transaction(function () use(&$post_data, &$referred_phone, &$student){
            $save_data = [
                            'user_id'     => $post_data['user_id'],
                            'name'        => $post_data['name'],
                            'email'       => $post_data['email'],
                            'phone'       => $post_data['phone'],
                            'address'     => $post_data['address'],
                            'postal_code' => $post_data['postal_code'],
                            'father_name' => $post_data['father_name'],
                            'category'       => $post_data['category'],
                            'is_muslim'      => $post_data['is_muslim']
	        			];
	        
	        $student = FranchiseStudent::create($save_data);

           

	        $Product = new StudentProduct;
	        $Product->student_id = $student->id;
	        $Product->pid = $post_data['pid'];
	        $Product->save();

	         foreach ($referred_phone as $ph) {
	        	$StudentReferredPhone = null;
	        	if (!empty($ph)) {
		        	$StudentReferredPhone = new StudentReferredPhone;
		        	$StudentReferredPhone->student_id = $student->id;
		        	$StudentReferredPhone->phone_number = $ph;
		        	$StudentReferredPhone->save();
	        	}
	        }
		});
         Mail::to($student->email)->send(new WelcomeStudent($student));
        return response()->json(['student' => $student->toArray()]);
    }

    public function studentFeeForm(Request $request, $student_id, $product_id)
    {
    	$user = $request->user();
    	$student = FranchiseStudent::find($student_id);
    	$student_product = StudentProduct::find($product_id);
    	// if ($student_product->is_fee_submitted) {
    	// 	return redirect('/student-details/'.$student_id);
    	// }
    	$product = Product::where('elc_id', $user->id)->where('pid', $student_product->pid)->get()->first();
    	$batches = Batch::where('elc_id', $user->id)->where('pid', $student_product->pid)->get();
    	return view('franchise.student.fee_form', ['student' => $student,'student_product' => $student_product, 'product' => $product, 'batches' => $batches]);
    }

    public function saveStudentFee(Request $request)
    {
        $payment_type = $request->input('payment_type');
        if ($payment_type == 'online') {
            $data = ['saveStudentFee' => $request->all()];
            $request->session()->put('online_payment', $data);
            return redirect('/payment');
        } 
        $last_date = new \DateTime();
        $last_date->modify('+30 days');
		$post_data                                = $request->all();
		$StudentProduct                           = StudentProduct::find($post_data['product_id']);
		if (!$StudentProduct->is_fee_submitted) {
			$StudentProduct->batch_id                 = $post_data['batch_id'];
			$StudentProduct->standard_fee             = $post_data['standard_fee'];
            $StudentProduct->max_discount_amount      = $post_data['max_discount_amount'];
            $StudentProduct->books_cost               = $post_data['books_cost'];
            $StudentProduct->student_discount         = $post_data['student_discount'];
            $StudentProduct->total_amount             = $post_data['total_amount'];
            //$StudentProduct->applicable_gst           = $post_data['applicable_gst'];
            $StudentProduct->net_due                  = $post_data['net_due'];
            $StudentProduct->amount_paid              = $post_data['amount_paid'];
            $StudentProduct->balance_amount           = $post_data['balance_amount'];
            $StudentProduct->last_fee_submission_date = $last_date->format('Y-m-d');
            $StudentProduct->class_type               = 'paid';
            $StudentProduct->status                   = 'active';
	        $StudentProduct->save();

			$transaction                     = new StudentTransaction;
            $transaction->product_id         = $post_data['product_id'];
            $transaction->invoice_number     = rand(1000000,9999999);
            $transaction->transaction_amount = $post_data['amount_paid'];
            $transaction->payment_type       = $payment_type;
            if ($payment_type == 'cheque') {
                $transaction->cheque_number = $post_data['cheque_number'];
                $transaction->bank_name     = $post_data['bank_name'];
                $transaction->branch_name   = $post_data['branch_name'];
                $transaction->cheque_date   = date('Y-m-d', strtotime($post_data['cheque_date']));
            }
			$transaction->save();

	        $StudentProduct->is_fee_submitted = 1;
	        $StudentProduct->save();
		}

        $request->session()->flash('success', 'Fee Submitted Successfully.');
        return redirect('/student-details/'.$post_data['student_id']);
    }

    public function saveBalanceFee(Request $request)
    {
        $payment_type = $request->input('payment_type');
        if ($payment_type == 'online') {
            $data = ['saveBalanceFee' => $request->all()];
            $request->session()->put('online_payment', $data);
            return redirect('/payment');
        }
        $post_data      = $request->all();
        $student_id     = $request->input('student_id');
        $product_id     = $request->input('product_id');
        $balance_amount = $request->input('balance_amount');
        
		
        $StudentProduct                 = StudentProduct::find($product_id);
		$StudentProduct->amount_paid    = $StudentProduct->amount_paid + $balance_amount;
		$StudentProduct->balance_amount = $StudentProduct->balance_amount - $balance_amount;
		$StudentProduct->save();
		
        $transaction                     = new StudentTransaction;
        $transaction->product_id         = $product_id;
        $transaction->invoice_number     = rand(1000000,9999999);
        $transaction->transaction_amount = $balance_amount;
        $transaction->payment_type       = $payment_type;
        if ($payment_type == 'cheque') {
            $transaction->cheque_number = $post_data['cheque_number'];
            $transaction->bank_name     = $post_data['bank_name'];
            $transaction->branch_name   = $post_data['branch_name'];
            $transaction->cheque_date   = date('Y-m-d', strtotime($post_data['cheque_date']));
        }
		$transaction->save();

        $request->session()->flash('success', 'Balance Amount submitted Successfully.');
        return redirect('/student-details/'.$student_id);
    }

    public function updateStudentDetails(Request $request)
    {
    	$student = null;
    	$post_data = $request->all();

        $validator = $this->updateValidator($post_data);
 //print_r($post_data);die;
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        DB::transaction(function () use(&$post_data, &$referred_phone, &$student){
        if (isset($post_data['id'])) {
			$student              = FranchiseStudent::find($post_data['id']);
			$student->name        = $post_data['name'];
			$student->email       = $post_data['email'];
			$student->address     = $post_data['address'];
			$student->postal_code = $post_data['postal_code'];
			$student->father_name = $post_data['father_name'];
			$student->save();
    	}
        foreach ($post_data['referred_phone'] as $ph) {
                $StudentReferredPhone = null;
                if (!empty($ph)) {
                    $StudentReferredPhone = new StudentReferredPhone;
                    $StudentReferredPhone->student_id = $student->id;
                    $StudentReferredPhone->phone_number = $ph;
                    $StudentReferredPhone->save();
                }
            }
            });
        $request->session()->flash('success', 'Profile updated Successfully.');
        return redirect('/student-details/'.$post_data['id']);
    }

    public function studentsList(Request $request)
    {
        return view('franchise.student.list_main');
    }

    public function loadStudentsList(Request $request)
    {
        $search = $request->input('search');
        $user = $request->user();
        $students = FranchiseStudent::where('user_id', $user->id)
                                        ->where(function($w) use ($search){
                                            $w->where('name','like', '%'.$search.'%')
                                            ->orwhere('email','like', '%'.$search.'%')
                                            ->orwhere('phone','like', '%'.$search.'%');
                                        })
                                        ->paginate(20);
        return view('franchise.student.load_list', ['students'=>$students]);
    }

    public function studentDetails(Request $request, $id)
    {
        $view = 'student_details';
        $referer_url = parse_url($request->server('HTTP_REFERER'));
        if ($referer_url['path'] == '/student-enquiry') {
            $request->session()->flash('success', 'Lead Captured Successfully.');
            return redirect($referer_url['path']);
        }
        if ($referer_url['path'] == '/student-request-demo') {
            $view = 'student_details_demo';
        }
        if ($referer_url['path'] == '/student-registration-form') {
            $view = 'student_details_paid';
        }
        $user = $request->user();
        $student = FranchiseStudent::where('user_id', $user->id)
                                        ->where('id', $id)
                                        ->get()->first();
        if (is_null($student)) {
        	$request->session()->flash('warning', 'No Student on Id '.$id);
        	return redirect('/franchise');
        }

        return view('franchise.student.'.$view,['student' => $student]);
    }

    public function demoClassForm(Request $request, $student_id, $product_id){
        $user = $request->user();
        $student = FranchiseStudent::find($student_id);
        $student_product = StudentProduct::find($product_id);
        // if ($student_product->is_fee_submitted) {
        //  return redirect('/student-details/'.$student_id);
        // }
        $product = Product::where('elc_id', $user->id)->where('pid', $student_product->pid)->get()->first();
        $batches = Batch::where('elc_id', $user->id)->where('pid', $student_product->pid)->get();
        return view('franchise.student.demo_class_form', ['student' => $student,'student_product' => $student_product, 'product' => $product, 'batches' => $batches]);
    }

    public function scheduleDemoClass(Request $request)
    {
        $post_data = $request->all();
        $StudentProduct = StudentProduct::find($post_data['product_id']);
        $StudentProduct->batch_id = $post_data['batch_id'];
        $StudentProduct->class_type = 'demo';
        $StudentProduct->save();

        $ProductDemo = new ProductDemo;
        $ProductDemo->product_id = $StudentProduct->id;
        $ProductDemo->batch_id = $post_data['batch_id'];
        $ProductDemo->demo_class_date = date('Y-m-d', strtotime($post_data['demo_class_date']));
        $ProductDemo->save();
        return response()->json(['student_product' => $StudentProduct]);
    }

    public function courseLeft(Request $request)
    {
        $post_data = $request->all();
        $StudentProduct = StudentProduct::find($post_data['product_id']);
        if (strtolower($post_data['status']) == 'left') {
            $StudentProduct->status = strtolower($post_data['status']);
            $StudentProduct->save();
        }
        return response()->json('Status updated Successfully.');
    }

    public function newProductForm(Request $request, $student_id)
    {
        $student = FranchiseStudent::find($student_id);
        return view('franchise.student.new_product_form', ['student' => $student]);
    }

    public function loadForm(Request $request)
    {
        $class_type = $request->input('class_type');
        $student_id = $request->input('student_id');
        $user = $request->user();
        $student = FranchiseStudent::find($student_id);
        $query = "SELECT pid FROM student_products where student_id = '" .$student_id."'";
        $student_product_ids = DB::SELECT(DB::raw($query));
        $student_product_ids = array_column(json_decode(json_encode($student_product_ids), true), 'pid');
        $products = Product::where('elc_id', $user->id)->whereNotIn('pid', $student_product_ids)->get();
        if ($class_type == 'demo') {
            return view('franchise.student.new_product_demo', ['student' => $student, 'products'=> $products]);
        } else {
            return view('franchise.student.new_product_paid', ['student' => $student, 'products'=> $products]);
        } 
    }

    public function scheduleNewDemo(Request $request)
    {
        $post_data = $request->all();

        $StudentProduct = new StudentProduct;
        $StudentProduct->student_id = $post_data['student_id'];
        $StudentProduct->pid = $post_data['product_id'];
        $StudentProduct->batch_id = $post_data['batch_id'];
        $StudentProduct->class_type = 'demo';
        $StudentProduct->save();

        $ProductDemo = new ProductDemo;
        $ProductDemo->product_id = $StudentProduct->id;
        $ProductDemo->batch_id = $post_data['batch_id'];
        $ProductDemo->demo_class_date = date('Y-m-d', strtotime($post_data['demo_class_date']));
        $ProductDemo->save();

        $request->session()->flash('success', 'Demo Class scheduled successfully.');
        return redirect('/student-details/'.$post_data['student_id']);
    }

    public function registerNewPaidProduct(Request $request)
    {
        $payment_type = $request->input('payment_type');
        if ($payment_type == 'online') {
            $data = ['registerNewPaidProduct' => $request->all()];
            $request->session()->put('online_payment', $data);
            return redirect('/payment');
        } 
        $last_date = new \DateTime();
        $last_date->modify('+30 days');
        $post_data                                = $request->all();

        $StudentProduct                           = new StudentProduct;
        $StudentProduct->student_id               = $post_data['student_id'];
        $StudentProduct->pid                      = $post_data['product_id'];
        $StudentProduct->batch_id                 = $post_data['batch_id'];
        $StudentProduct->standard_fee             = $post_data['standard_fee'];
        $StudentProduct->max_discount_amount      = $post_data['max_discount_amount'];
        $StudentProduct->books_cost               = $post_data['books_cost'];
        $StudentProduct->student_discount         = $post_data['student_discount'];
        $StudentProduct->total_amount             = $post_data['total_amount'];
        // $StudentProduct->applicable_gst           = $post_data['applicable_gst'];
        $StudentProduct->net_due                  = $post_data['net_due'];
        $StudentProduct->amount_paid              = $post_data['amount_paid'];
        $StudentProduct->balance_amount           = $post_data['balance_amount'];
        $StudentProduct->last_fee_submission_date = $last_date->format('Y-m-d');
        $StudentProduct->class_type               = 'paid';
        $StudentProduct->status                   = 'active';
        $StudentProduct->save();

        $transaction                     = new StudentTransaction;
        $transaction->product_id         = $StudentProduct->id;
        $transaction->invoice_number     = rand(1000000,9999999);
        $transaction->transaction_amount = $post_data['amount_paid'];
        $transaction->payment_type       = $payment_type;

        if ($payment_type == 'cheque') {
            $transaction->cheque_number = $post_data['cheque_number'];
            $transaction->bank_name     = $post_data['bank_name'];
            $transaction->branch_name   = $post_data['branch_name'];
            $transaction->cheque_date   = date('Y-m-d', strtotime($post_data['cheque_date']));
        }
        $transaction->save();

        $StudentProduct->is_fee_submitted = 1;
        $StudentProduct->save();

        $request->session()->flash('success', 'Fee Submitted Successfully.');
        return redirect('/student-details/'.$post_data['student_id']);
    }

    public function studentEditProfile(Request $request, $student_id)
    {  
        $referred_phones = StudentReferredPhone::where('student_id','=',$student_id)->get();
        $student = FranchiseStudent::find($student_id);
        return view('franchise.student.edit_profile', ['student' => $student],['referred_phones' => $referred_phones]);
    }

    public function studentsLeadList(Request $request)
    {
        return view('franchise.student.lead_list_main');
    }

    public function loadStudentsLeadList(Request $request)
    {
        $search = $request->input('search');
        $user = $request->user();
        $students = FranchiseStudent::where('user_id', $user->id)
                                        ->where(function($w) use ($search){
                                            $w->where('name','like', '%'.$search.'%')
                                            ->orwhere('email','like', '%'.$search.'%')
                                            ->orwhere('phone','like', '%'.$search.'%');
                                        })
                                        ->paginate(20);
        return view('franchise.student.load_list', ['students'=>$students]);
    }
}
