@if($products->count() > 0)
<div class="card">
    <div id="BasicDetails">
        <div class="card-body">
            <form method="POST" class="form-group" action="{{url('/register-new-paid-product')}}" onsubmit="return checkDiscount()">
                @csrf
                <input type="hidden" name="student_id" value="{{$student->id}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <select id="product_id" autocomplete="off" name="product_id" required>
                                <option value="">--Select Course--</option>
                                @foreach($products as $product)
                                <option data-min_fee_allowed="{{$product->min_fee_allowed}}" data-max_fee_allowed="{{$product->max_fee_allowed}}" data-min_fee_books_services="{{$product->min_fee_books_services}}" value="{{$product->pid}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                            <div class="input-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <select id="batch_id" autocomplete="off" name="batch_id" required>
                                
                            </select>
                            <div class="input-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Standard Fee: ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="standard_fee">
                            <div id="standard_fee" class="textVal"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Max Discount Amount : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="max_discount_amount">
                            <div id="max_discount_amount" class="textVal"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Cost of Books : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="books_cost">
                            <div id="books_cost" class="textVal"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Discount (if any) : ') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="formControl noIcon amountTxt">
                            <div class="textVal">
                                <input id="student_discount" type="text" class="textRight cyanText" style="width: auto;" name="student_discount" placeholder="Discount for student" value="0" required>
                            </div>
                            <div id="student-discount-message" class="errorMsg"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Net Fee + Books :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="amountTxt">
                            <input type="hidden" name="total_amount">
                            <div id="total_amount" class="textVal"></div>
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
                            <input type="hidden" name="net_due">
                            <div id="net_due" class="textVal"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <label class="">{{ __('Paying Amount :') }}</label>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="formControl noIcon amountTxt">
                            <div class="textVal">
                                <input id="amount_paid" type="text" class="textRight cyanText" style="width: auto;" name="amount_paid" placeholder="Amount Paid" value="0" required>
                            </div>
                            <div id="student-discount-message" class="errorMsg"></div>
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
            <div class="radioGroup"  style="justify-content:flex-end">
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
                    <div class="col-xs-12 col-sm-12">
                        <button type="submit" id="pay-now" name="submit" class="btn btn-primary pull-right">
                            {{ __('Pay Now') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body">
        <div> No Products Available</div>
        <a href="{{url('/student-details/'.$student->id)}}">Back to Profile</a>
    </div>
</div>
@endif
<script type="text/javascript">
function getProductBatches(pid) {
    $('.loading').show();
    $.ajax({
        type: 'POST',
        url: "/get-product-batches",
        data: { _token: "{{csrf_token()}}", pid: pid },
        async : true,
        success: function(res) {
            console.log(res);
            $('#batch_id').html(res);
            $('.loading').hide();
        },

        error: function(error) {
            console.log(error);
        }
    });
}

function setFeeColumns() {
    var selected_product = $('#product_id option:selected');
    var max_fee_allowed = selected_product.data('max_fee_allowed');
    var min_fee_allowed = selected_product.data('min_fee_allowed');
    var books_cost = selected_product.data('min_fee_books_services');
    console.log(max_fee_allowed, min_fee_allowed, books_cost);
    var discount_amount = max_fee_allowed - min_fee_allowed;
    var total_amount = max_fee_allowed + books_cost;
    
    var net_due = parseInt(total_amount);
    $('#total_amount').text(total_amount);
    $('#standard_fee').text(max_fee_allowed);
    $('#max_discount_amount').text(discount_amount);
    $('#books_cost').text(books_cost);       
    $('#net_due').text(net_due);
    $('input[name="total_amount"]').val(total_amount);
    $('input[name="standard_fee"]').val(max_fee_allowed); 
    $('input[name="max_discount_amount"]').val(discount_amount);
    $('input[name="books_cost"]').val(books_cost);
    $('input[name="net_due"]').val(net_due);
}

function checkDiscount() {
    var student_discount = parseFloat($('#student_discount').val());
    console.log(student_discount);
    var max_discount_amount = parseFloat($('#max_discount_amount').text());
    if (isNaN(student_discount) || student_discount < 0) {
        $('#student-discount-message').html('Invalid Discount');
        return false;
    }
	
    if (student_discount > max_discount_amount) {
        $('#student-discount-message').html('Discount cant exceed '+ max_discount_amount);
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

$('#product_id').on('change', function() {
    var pid = $('#product_id option:selected').val();
    setFeeColumns();
    getProductBatches(pid);
});

$('#student_discount').on('keyup', function(){
    $('#student-discount-message').html('');
    $('input[name="amount_paid"]').val('');
    $('input[name="balance_amount"]').val('');
    $('#balance_amount').text('');
    var student_discount = parseFloat($('#student_discount').val());
    var max_discount_amount = parseFloat($('#max_discount_amount').text());
    if (isNaN(student_discount) || student_discount < 0) {
        $('#student-discount-message').html('Invalid Discount');
        return;
    }
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

</script>
