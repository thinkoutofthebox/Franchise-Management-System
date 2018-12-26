@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
    <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{$student->name }}</div>
	 <div class="addStudent">
               <a href="{{url('/student-details'.'/'.$student->id)}}" class="btn btn-link"><i class="fa fa-arrow-left"></i> Back to student profile</a>
        </div>
</header>
@endsection  
@section ('content')
<h3 class="sectionTitle">Product: {{$product->product_name}}</h3>
@if(!$student_product->is_fee_submitted)
<div class="card">
    <div id="FeesDetails">
        <div class="card-body">
            <form method="POST" class="form-group" action="{{url('/save-student-fee')}}" onsubmit="return checkDiscount()">
                @csrf
                <input type="hidden" name="student_id" id="student_id" value="{{$student->id}}">
                <input type="hidden" name="product_id" id="product_id" value="{{$student_product->id}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label class="">{{ __('Choose a Batch to Enroll : ') }}</label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl noIcon">
                            <select id="batch_id" autocomplete="off" name="batch_id" required>
                                <option value="">--Choose Batch--</option>
                                @foreach($batches as $batch)
                                    <option value="{{$batch->id}}">{{$batch->batch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Standard Fee : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="standard_fee" value="{{$product->max_fee_allowed}}">
                            <div id="standard_fee" class="textVal">{{$product->max_fee_allowed}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Max Discount Amount : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="max_discount_amount" value="{{$product->max_fee_allowed - $product->min_fee_allowed}}">
                            <div id="max_discount_amount" class="textVal">{{$product->max_fee_allowed - $product->min_fee_allowed}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Cost of Books : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="books_cost" value="{{$product->min_fee_books_services}}">
                            <div id="books_cost" class="textVal">{{$product->min_fee_books_services}}</div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Discount (if any) : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="formControl noIcon discountTxt">
                            <input id="student_discount" type="text" name="student_discount" placeholder="Discount for student" value="0" required>
                            <div id="student-discount-message" style="color:red;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Fee + Books :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="total_amount" value="{{$product->max_fee_allowed + $product->min_fee_books_services}}">
                            <div id="total_amount" class="textVal">{{$product->max_fee_allowed + $product->min_fee_books_services}}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Due :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="net_due" value="{{$product->max_fee_allowed + $product->min_fee_books_services + 100}}">
                            <div id="net_due" class="textVal">{{$product->max_fee_allowed + $product->min_fee_books_services + 100}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Paying Amount :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="formControl noIcon">
                            <input id="amount_paid" type="text" name="amount_paid" min="1" placeholder="Amount Paid" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Balance :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="balance_amount">
                            <div id="balance_amount" class="textVal"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Payment Type :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6 pull-right formControl">
                        <div class="radioGroup" style="justify-content:flex-end">
                            <div class="radio-item">
                                <input id="payment_type_cash" type="radio" name="payment_type" value="offline" checked>
                                <label for="payment_type_cash">Cash</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="payment_type_cheque" name="payment_type" value="cheque">
                                <label for="payment_type_cheque">Cheque</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="payment_type_online" name="payment_type" value="online">
                                <label for="payment_type_online">Online</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="cheque-details" style="display: none;">
                     <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Cheque Details :') }}</label>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="cheque_number" type="text" name="cheque_number" placeholder="Cheque Number">
                                <div id="error-cheque_number" style="color:red;"></div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="bank_name" type="text" name="bank_name" placeholder="Bank Name">
                                <div id="error-bank_name" style="color:red;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="branch_name" type="text" name="branch_name" placeholder="Branch Name">
                                <div id="error-branch_name" style="color:red;"></div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="cheque_date" type="text" name="cheque_date" placeholder="Cheque Date (YYYY-MM-DD)">
                                <div id="error-cheque_date" style="color:red;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" class="btn btn-primary pull-right">
                            {{ __('Pay Now') }}
                        </button>
                    </div>
                </div>
                <p class="pull-right">***Inclusive of all taxes</p>
            </form>
        </div>
    </div>
</div>
@else
<div class="card">
    <div id="FeesDetails">
        <div class="card-body">
            <form method="POST" class="form-group" action="{{url('/save-balance-fee')}}" onsubmit="return checkBalanceAmount()">
                @csrf
                <input type="hidden" name="student_id" id="student_id" value="{{$student->id}}">
                <input type="hidden" name="product_id" id="product_id" value="{{$student_product->id}}">

                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Standard Fee : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="standard_fee" value="{{$product->max_fee_allowed}}">
                            <div id="standard_fee" class="textVal">{{$product->max_fee_allowed}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Max Discount Amount : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="max_discount_amount" value="{{$product->max_fee_allowed - $product->min_fee_allowed}}">
                            <div id="max_discount_amount" class="textVal">{{$product->max_fee_allowed - $product->min_fee_allowed}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Cost of Books : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="books_cost" value="{{$product->min_fee_books_services}}">
                            <div id="books_cost" class="textVal">{{$product->min_fee_books_services}}</div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Discount Given : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="student_discount" value="{{$student_product->student_discount}}">
                            <div id="student_discount" class="textVal">{{$student_product->student_discount}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Fee + Books :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="total_amount" value="{{$student_product->total_amount}}">
                            <div id="total_amount" class="textVal">{{$student_product->total_amount}}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Due :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="net_due" value="{{$student_product->net_due}}">
                            <div id="net_due" class="textVal">{{$student_product->net_due}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Paid Amount :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="amount_paid" value="{{$student_product->amount_paid}}">
                            <div id="amount_paid" class="textVal">{{$student_product->amount_paid}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Balance :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="formControl noIcon amountTxt">
			    <div class="textVal">
                            	<input id="balance_amount" type="text" class="textRight" style="width:auto;" name="balance_amount" value="{{$student_product->balance_amount}}" required>
			    </div>
                            <span id="error-balance_amount" class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Payment Type :') }}</label>
                    </div>
		    <div class="col-xs-6 col-sm-6 pull-right formControl">
                        <div class="radioGroup" style="justify-content:flex-end">
                                <div class="radio-item">
                                        <input id="payment_type_cash" type="radio" name="payment_type" value="offline" checked>
                                        <label for="payment_type_cash">Cash</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="payment_type_cheque" name="payment_type" value="cheque">
                                    <label for="payment_type_cheque">Cheque</label>
                                </div>
                                <div class="radio-item">
                                        <input type="radio" id="payment_type_online" name="payment_type" value="online">
                                        <label for="payment_type_online">Online</label>
                                </div>
                        </div>
                    </div>
                </div>
                <div id="cheque-details" style="display: none;">
                     <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Cheque Details :') }}</label>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="cheque_number" type="text" name="cheque_number" placeholder="Cheque Number">
                                <div id="error-cheque_number" style="color:red;"></div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="bank_name" type="text" name="bank_name" placeholder="Bank Name">
                                <div id="error-bank_name" style="color:red;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="branch_name" type="text" name="branch_name" placeholder="Branch Name">
                                <div id="error-branch_name" style="color:red;"></div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6">
                            <div class="formControl noIcon discountTxt">
                                <input id="cheque_date" type="text" name="cheque_date" placeholder="Cheque Date (YYYY-MM-DD)">
                                <div id="error-cheque_date" style="color:red;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" class="btn btn-primary pull-right">
                            {{ __('Pay Amount Now') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="card-body">
            <div id="previous-transaction-details">
               <h3 class="section-title"> Last Payments</h3>
                
                <table class="table">
                    <tr>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Invoice Number</th>
                        <th>Payment</th>
                    </tr>
                    @foreach($student_product->transactions as $transaction)
                    <tr>
                    <td>{{date('d F Y', strtotime($transaction->created_at))}}</td>
                    <td><i class="fa fa-rupee"></i> {{$transaction->transaction_amount}}</td>
                    <td>{{$transaction->invoice_number}}</td>
                    <td>{{ucwords($transaction->payment_type)}}</td>
                    </tr>
                    @endforeach
                </table>        
            </div>
        </div>
    </div>
</div>

@endif
@endsection
@section('scripts')
<script type="text/javascript">
	function checkDiscount() {
        console.log('checkDiscount');
	    var student_discount = parseFloat($('#student_discount').val());
        console.log(student_discount);
	    var max_discount_amount = parseFloat($('#max_discount_amount').text());
	    if (isNaN(student_discount)|| student_discount < 0) {
	        $('#student-discount-message').html('Invalid Discount');
	        return false;
	    }
	    if (student_discount > max_discount_amount) {
	        $('#student-discount-message').html('Discount can not exceed '+ max_discount_amount);
	        return false;
	    }

        if ($('input[type="radio"][name="payment_type"]:checked').val() == 'cheque') {
            var cheque_date = $('#cheque_date').val();
            if (!ValidateDate(cheque_date)) {
                $('#error-cheque_date').html('Invalid Date');
                return false;
            }
        }
	}

	function checkBalanceAmount() {
		var balance_amount = parseFloat($('#balance_amount').val());
	    if (isNaN(balance_amount) || balance_amount <= 0) {
	        $('#error-balance_amount').html('Invalid Amount');
	        return false;
	    }

        if ($('input[type="radio"][name="payment_type"]:checked').val() == 'cheque') {
            var cheque_date = $('#cheque_date').val();
            if (!ValidateDate(cheque_date)) {
                $('#error-cheque_date').html('Invalid Date');
                return false;
            }
        }
	}

    $('input[type="radio"][name="payment_type"]').on('click', function() {
        if ($('input[type="radio"][name="payment_type"]:checked').val() == 'cheque') {
            $('#cheque-details').show();
            $('#cheque_number').prop('required', true);
            $('#bank_name').prop('required', true);
            $('#branch_name').prop('required', true);
            $('#cheque_date').prop('required', true);
        } else {
            $('#cheque-details').hide();
            $('#cheque_number').prop('required', false);
            $('#bank_name').prop('required', false);
            $('#branch_name').prop('required', false);
            $('#cheque_date').prop('required', false);
        }
    });

    $('#student_discount').on('keyup', function(){
        $('#student-discount-message').html('');
        $('input[name="amount_paid"]').val('');
        $('input[name="balance_amount"]').val('');
        $('#balance_amount').text('');
        console.log($('#student_discount').val());
        var student_discount = parseFloat($('#student_discount').val());
        if (isNaN(student_discount) || student_discount < 0) {
            $('#student-discount-message').html('Invalid Discount');
            return;
        }
        var max_discount_amount = parseFloat($('#max_discount_amount').text());
        if (student_discount > max_discount_amount) {
            $('#student-discount-message').html('Discount cant exceed '+ max_discount_amount);
            return;
        }
        var standard_fee = parseFloat($('#standard_fee').text());
        var books_cost = parseFloat($('#books_cost').text());
        
        var total_amount = standard_fee - student_discount + books_cost;
        var net_due = total_amount;
        $('#total_amount').text(total_amount);
        $('#net_due').text(net_due);
        $('input[name="total_amount"]').val(total_amount);
        $('input[name="net_due"]').val(net_due);
    });

    $('#amount_paid').on('keyup', function(){
        var net_due =$('#net_due').text();
        var amount_paid = parseFloat($('#amount_paid').val());
        var balance_amount = net_due - amount_paid;
        $('#balance_amount').text(balance_amount);
        $('input[name="balance_amount"]').val(balance_amount);
    });
</script>
@stop
