@if($products->count() > 0)
<div class="card">
    <div id="BasicDetails">
        <div class="card-body">
            <form method="POST" class="form-group" action="{{url('schedule-new-demo')}}" onsubmit="checkDate()">
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

                <div class="row">
                     <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <input type="text" name="demo_class_date" id="demo_class_date" placeholder="YYYY-MM-DD">
                            <span id="error-demo_class_date" class="invalid-feedback"></span>
                        </div>
                        <div class="input-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <button type="submit" id="enrol" name="submit" class="btn btn-primary">
                            {{ __('Schedule') }}
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

$('#product_id').on('change', function() {
    var pid = $('#product_id option:selected').val();
    getProductBatches(pid);
});

function checkDate() {
    var demo_class_date = $('#demo_class_date').val().trim();
    if (demo_class_date.length == 0 || !ValidateDate(demo_class_date) ) {
        $('#error-demo_class_date').html('Invalid Date');
        return false;
    }
}
</script>