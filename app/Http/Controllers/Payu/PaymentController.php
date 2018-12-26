<?php

namespace App\Http\Controllers\Payu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tzsk\Payu\Facade\Payment;
use Illuminate\Support\Facades\Log;
use App\FranchiseStudent;
use App\StudentProduct;
use App\StudentTransaction;

use App\Product;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
    	if (!$request->session()->has('online_payment')) {
		    $request->session()->flash('warning', 'No Payment Pending.');
            return redirect('/franchise');
		}

    	$online_payment = $request->session()->get('online_payment');
    	$function_name = null;
    	$post_data = null;
    	$student = null;
    	$pid = null;
    	$amount = null;
    	foreach ($online_payment as $key => $value) {
    		$function_name = $key;
    		$post_data = $value;
    	}

    	$student = FranchiseStudent::find($post_data['student_id']);

    	switch ($function_name) {
    		case 'registerNewPaidProduct':
    			$pid = $post_data['product_id'];
    			$amount = $post_data['amount_paid'];
    			break;
    		case 'saveStudentFee':
    			$sp = StudentProduct::find($post_data['product_id']);
    			$pid = $sp->pid;
    			$amount = $post_data['amount_paid'];
    			break;
    		case 'saveBalanceFee':
    			$sp = StudentProduct::find($post_data['product_id']);
    			$pid = $sp->pid;
    			$amount = $post_data['balance_amount'];
    			break;
    		default:
    			break;
    	}

    	$attributes = [
            'txnid'       => strtoupper(str_random(12)), # Transaction ID.
            'amount'      => 1, //$amount, # Amount to be charged.
            'productinfo' => $pid,
            'firstname'   => $student->name, # Payee Name.
            'email'       => $student->email, # Payee Email Address.
            'phone'       => $student->phone,
            'udf1'        => $student->email, # Payee Phone Number
            'udf2'        => $student->phone
		];

		return Payment::make($attributes, function ($then) {
		    // $then->redirectTo('payment/status');
		    // # OR...
		    // $then->redirectRoute('payment.status');
		    // # OR...
		    $then->redirectAction('Payu\PaymentController@status');
		});
    }

    public function status(Request $request)
    {
    	if (!$request->session()->has('online_payment')) {
            $request->session()->flash('warning', 'No Payment Pending.');
            return redirect('/franchise');
        }
        $function_name  = null;
        $post_data      = null;
        $payment = Payment::capture();
    	$txnid = $payment->txnid;
        $online_payment = $request->session()->get('online_payment');
        foreach ($online_payment as $key => $value) {
            $function_name = $key;
            $post_data     = $value;
        }
		if ($payment->isCaptured()) {			
	    	$this->{$function_name}($post_data, $txnid, $request);
	    	$request->session()->flash('success', 'Payment Done Successfully.');
		} else {
            $request->session()->flash('warning', 'Payment declined by User.');
		}
        $request->session()->forget('online_payment');
        return redirect('/student-details/'.$post_data['student_id']);
    }

    private function registerNewPaidProduct($post_data, $txnid, $request)
    {
    	$payment_type = $post_data['payment_type'];
        
        $last_date = new \DateTime();
        $last_date->modify('+30 days');

        $StudentProduct                           = new StudentProduct;
        $StudentProduct->student_id               = $post_data['student_id'];
        $StudentProduct->pid                      = $post_data['product_id'];
        $StudentProduct->batch_id                 = $post_data['batch_id'];
        $StudentProduct->standard_fee             = $post_data['standard_fee'];
        $StudentProduct->max_discount_amount      = $post_data['max_discount_amount'];
        $StudentProduct->books_cost               = $post_data['books_cost'];
        $StudentProduct->student_discount         = $post_data['student_discount'];
        $StudentProduct->total_amount             = $post_data['total_amount'];
        $StudentProduct->applicable_gst           = $post_data['applicable_gst'];
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
		$transaction->txnid              = $txnid;
        $transaction->save();

        $StudentProduct->is_fee_submitted = 1;
        $StudentProduct->save();

        // $request->session()->flash('success', 'Fee Submitted Successfully.');
        // return redirect('/student-details/'.$post_data['student_id']);
    }

    private function saveStudentFee($post_data, $txnid, $request)
    {
    	$payment_type = $post_data['payment_type'];

        $last_date = new \DateTime();
        $last_date->modify('+30 days');

		$StudentProduct                           = StudentProduct::find($post_data['product_id']);
		if (!$StudentProduct->is_fee_submitted) {
			$StudentProduct->batch_id                 = $post_data['batch_id'];
			$StudentProduct->standard_fee             = $post_data['standard_fee'];
            $StudentProduct->max_discount_amount      = $post_data['max_discount_amount'];
            $StudentProduct->books_cost               = $post_data['books_cost'];
            $StudentProduct->student_discount         = $post_data['student_discount'];
            $StudentProduct->total_amount             = $post_data['total_amount'];
            $StudentProduct->applicable_gst           = $post_data['applicable_gst'];
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
			$transaction->txnid              = $txnid;
			$transaction->save();

	        $StudentProduct->is_fee_submitted = 1;
	        $StudentProduct->save();
		}

        // $request->session()->flash('success', 'Fee Submitted Successfully.');
        // return redirect('/student-details/'.$post_data['student_id']);
    }

    private function saveBalanceFee($post_data, $txnid, $request)
    {
    	$payment_type = $post_data['payment_type'];
       
        $student_id     = $post_data['student_id'];
        $product_id     = $post_data['product_id'];
        $balance_amount = $post_data['balance_amount'];
        
		
        $StudentProduct                 = StudentProduct::find($product_id);
		$StudentProduct->amount_paid    = $StudentProduct->amount_paid + $balance_amount;
		$StudentProduct->balance_amount = $StudentProduct->balance_amount - $balance_amount;
		$StudentProduct->save();
		
		$transaction                     = new StudentTransaction;
		$transaction->product_id         = $product_id;
		$transaction->invoice_number     = rand(1000000,9999999);
		$transaction->transaction_amount = $balance_amount;
		$transaction->payment_type       = $payment_type;
		$transaction->txnid              = $txnid;
		$transaction->save();

        // $request->session()->flash('success', 'Balance Amount submitted Successfully.');
        // return redirect('/student-details/'.$student_id);
    }
}
