@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
   <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{$student->name }} (Demo Class)</div>
	<div class="addStudent">
               <a href="{{url('/student-details'.'/'.$student->id)}}" class="btn btn-link"><i class="fa fa-arrow-left"></i> Back to student profile</a>
        </div>
</header>
@endsection  
@section ('content')
<h3>Product: {{$product->product_name}}</h3>
<div class="card">
    <div id="FeesDetails">
        <div class="card-body">
            <form method="POST" class="form-group" onsubmit="return setDemoClass()">
                <input type="hidden" name="student_id" id="student_id" value="{{$student->id}}">
                <input type="hidden" name="product_id" id="product_id" value="{{$student_product->id}}">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label class="">{{ __('Demo Class Date : ') }}</label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl noIcon">
                            <input type="text" id="demo_class_date" name="demo_class_date" placeholder="YYYY-MM-DD" autocomplete="off">
                            <span id="error-demo_class_date" class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label class="">{{ __('Choose a Batch to Demo Class : ') }}</label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl noIcon">
                            <select id="batch_id" autocomplete="off" name="batch_id" required>
                                <option value="">--Choose Batch--</option>
                                @foreach($batches as $batch)
                                    <option value="{{$batch->id}}">{{$batch->batch_name}} ({{'Timings: '.$batch->batch_timing_start.''.$batch->batch_timing_end}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" class="btn btn-secondary pull-right">
                            {{ __('Take Demo') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    
    function setDemoClass() {
        var student_id = $('#student_id').val();
        var product_id = $('#product_id').val();
        var demo_class_date = $('#demo_class_date').val().trim();
        var batch_id = $('#batch_id option:selected').val();
        if (demo_class_date.length == 0 || !ValidateDate(demo_class_date) ) {
            $('#error-demo_class_date').html('Invalid Date');
            return false;
        }
        var _data = {_token:"{{csrf_token()}}", student_id:student_id,product_id:product_id, demo_class_date:demo_class_date, batch_id:batch_id};
        console.log(_data);
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: '/schedule-demo-class',
            data: _data,
            async : true,
            success: function(res) {
                console.log(res);
                $('.loading').hide();
                if(res.student_product != undefined){
                    location.href= '/student-details/'+ res.student_product.student_id;
                }
            },

            error: function(error) {
                console.log(error);
            }
        });
        return false;
    }
</script>
@stop
