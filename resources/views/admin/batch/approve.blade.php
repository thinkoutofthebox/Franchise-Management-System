@extends('layouts.admin')
@section('styles')
	<link href="{{ asset('css/formLayout.css') }}" rel="stylesheet">
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{ __('Approve Batch') }}</div>
</header>
@endsection
@section('content')

<pre><?php  //print_r($franchises->toArray()); 
?></pre>
           <div class="card">
                <div class="card-body">
                    <div class="col-xs-12 col-sm-6" id="productInput">
                    <div class="formControl">
                        <label>{{$batch->product_name}}</label>
                    </div>
                </div>
                    <form method="POST" class="form-group" action="{{ url('approve-batch') }}" onsubmit="return validateForm();">
                        @csrf
                    <input type="hidden" name="id" value="{{$batch->id}}">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                                <input id="batch_desc" type="text" class="{{ $errors->has('batch_desc') ? ' is-invalid' : '' }}" name="batch_desc" value="{{$batch->batch_name}}" placeholder="Batch Description" required autofocus>
                                <div class="input-icon"><i class="fa fa-sort-desc"></i></div>

                                @if ($errors->has('batch_desc'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_desc') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                                <input id="batch_name" type="text" class="{{ $errors->has('batch_name') ? ' is-invalid' : '' }}" name="batch_name" value="{{$batch->batch_name}}" placeholder="Batch Name" required autofocus>
                                <div class="input-icon"><i class="fa fa-object-group"></i></div>

                                @if ($errors->has('batch_name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                            <input type="text" class="txtDate {{ $errors->has('batch_start') ? ' is-invalid' : '' }}" name="batch_start" id="batch_start" value="{{ $batch->batch_start}}" placeholder="Batch Start Date (YYYY-MM-DD)" required autofocus/>
                             <div class="input-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            </div>
                            <span id="batch_start_error" class="invalid-feedback" role="alert" >
                                    </span>
                             @if ($errors->has('batch_start'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_start') }}</strong>
                                </span>
                                @endif   
                            </div>
                        </div>
                          <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                                <input type="text" class="txtDate {{ $errors->has('batch_end') ? ' is-invalid' : '' }}" name="batch_end" id="batch_end" value="{{ $batch->batch_end}}" placeholder="Batch End Date (YYYY-MM-DD)" required autofocus/>
                                 <div class="input-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                </div>
                                <span id="batch_end_error" class="invalid-feedback" role="alert" >
                                </span> 
                                 @if ($errors->has('batch_end'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('batch_end') }}</strong>
                                    </span>
                                    @endif        
                            </div>       
                        </div>
                    </div>         
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">   
                                <input type="text" class="txtDate {{ $errors->has('batch_timing_start') ? ' is-invalid' : '' }}" name="batch_timing_start" id="batch_timing_start" value="{{ $batch->batch_timing_start }}" placeholder="Batch Timming Start (Hr:Min)  Example  02:02" required autofocus/>
                                <div class="input-icon"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                                <span id="batch_timing_start_error" class="invalid-feedback" role="alert" ></span>
                                @if ($errors->has('batch_timing_start'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_timing_start') }}</strong>
                                </span>
                                @endif  
                            </div>                                                  
                        </div>
                          <div class="col-xs-12 col-sm-6">
                            <div class="formControl">   
                                <input type="text"  class="batch_timing_end{{ $errors->has('batch_timing_end') ? ' is-invalid' : '' }}" name="batch_timing_end" id="batch_timing_end" value="{{ $batch->batch_timing_end }}" placeholder="Batch Timming End (Hr:Min) Example 02:02" required autofocus/>
                                <div class="input-icon"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                                <span id="batch_timing_end_error" class="invalid-feedback" role="alert" ></span>
                                @if ($errors->has('batch_timing_end'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_timing_end') }}</strong>
                                </span>
                                @endif  
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">   
                            <input type="text" class="txtDate {{ $errors->has('batch_last_date_adm') ? ' is-invalid' : '' }}" name="batch_last_date_adm" id="batch_last_date_adm" value="{{ $batch->batch_last_date_adm}}" placeholder="Batch Last Date Adm (YYYY-MM-DD)" required autofocus/>
                            <div class="input-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            </div>
                             <span id="batch_last_date_adm_error" class="invalid-feedback" role="alert" ></span>
                             @if ($errors->has('batch_last_date_adm'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('batch_last_date_adm') }}</strong>
                                </span>
                                @endif   
                            </div>
                        </div>
                            <?php $status=['1' => 'Yes', '0' => 'No'];?> 
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                                <select id="status" autocomplete="off" name="status" required>
                                <option value="">--Select Status--</option>
                                @foreach($status as $key => $status)
                                <option value="{{$key}}" {{($key == $batch->status)?"selected":""}}>{{$status}}</option>
                                @endforeach
                                </select>
                                <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">
                        {{ __('Create') }}
                        </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

@endsection

@section('scripts')
<script type="text/javascript">
function getProductBatches(elc_id) {
    $('.loading').show();
    $.ajax({
        type: 'POST',
        url: "/get-product-elc",
        data: { _token: "{{csrf_token()}}", elc_id: elc_id },
        async : true,
        success: function(res) {
            console.log(res);
            $('#pid').html(res);
            $('.loading').hide();
        },

        error: function(error) {
            console.log(error);
        }
    });
}


$(document).ready(function() {
    console.log('ok');
    $('#elc_id').on('change', function() {
        var elc_id = $('#elc_id option:selected').val();
        console.log(elc_id);
        getProductBatches(elc_id);
        $("#productInput").show();

    });  
 }); 

function validateForm(){
var batch_start = $('#batch_start').val();
    batch_end = $('#batch_end').val(),
    batch_last_date_adm = $('#batch_last_date_adm').val(),
    batch_timing_start = $('#batch_timing_start').val(),
    batch_timing_end = $('#batch_timing_end').val();
            if(ValidateDate(batch_start)){
                $("#batch_start_error").html("");
            }
            if(ValidateDate(batch_end)){
                $("#batch_end_error").html("");
            }
            if(ValidateDate(batch_last_date_adm)){
                $("#batch_last_date_adm_error").html("");
            }
             if(ValidateDateTime(batch_timing_start)){
                $("#batch_timing_start_error").html("");
            }

            if(ValidateDateTime(batch_timing_end)){
                $("#batch_timing_end_error").html("");
            }
            if(!ValidateDate(batch_start)){
                $("#batch_start_error").html("Please select correct date");
                //i++;
                return false;
            }
            if(!ValidateDate(batch_end)){
                $("#batch_end_error").html("Please select correct date");
               // i++;    
               return false;
            }
            if(!ValidateDate(batch_last_date_adm)){
                $("#batch_last_date_adm_error").html("Please select correct date");
                //i++;  
                return false;
            }
            if(!ValidateDateTime(batch_timing_start)){
                $("#batch_timing_start_error").html("Please select correct Time");
                //i++;  
                return false;
            }
            if(!ValidateDateTime(batch_timing_end)){
                $("#batch_timing_end_error").html("Please select correct Time");
               //i++;
               return false;
            }
            return true;
    }
</script>
@stop
