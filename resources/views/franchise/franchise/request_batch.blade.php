@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
    <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{'Request Batch'}}</div>
</header>
@endsection 
@section('content')
 <div class="card">
    <div id="BasicDetails">
        <div class="card-body">
                <form method="POST" class="form-group" action="{{ url('request-batch') }}" onsubmit="return validateData()">
                    @csrf
                        <input id="id" type="hidden"  name="elc_id" value="{{auth()->user()->id}}" placeholder="">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                        <select id="pid" type="text" class="form-control {{ $errors->has('pid') ? ' is-invalid' : '' }}" name="pid" value="" placeholder="Product" required autofocus>
                                        	<option value="">---Select Product---</option>
                                            @foreach($products as $key => $product)
                                                <option value="{{$product->pid.'_'.$product->product_name}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-icon"><i class="fa fa-user"></i></div>
                                        @if ($errors->has('pid'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('pid') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="father_name" class="col-md-4 col-form-label text-md-right">{{ __('father_name') }}</label> -->
                                        <input id="batch_name" type="text" class="form-control {{ $errors->has('batch_name') ? ' is-invalid' : '' }}" name="batch_name" value="" placeholder="Batch Name" required autofocus>
                                        <div class="input-icon"><i class="fa fa-user"></i></div>
                                        <!-- @if ($errors->has('father_name'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('father_name') }}</strong>
                                                </span>
                                        @endif -->
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label> -->
                                        <input id="batch_desc" type="text" class="form-control {{ $errors->has('batch_desc') ? ' is-invalid' : '' }}" name="batch_desc" value="" placeholder="Batch description" required autofocus>
                                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                        @if ($errors->has('batch_desc'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('batch_desc') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('phone') }}</label> -->
                                        <input id="batch_start" type="text" class="{{ $errors->has('batch_start') ? ' is-invalid' : '' }}" name="batch_start" value="" placeholder="Batch start YYYY-MM-DD" required  autofocus>
                                        <div class="input-icon"><i class="fa fa-phone"></i></div>
                                        <span id="errors-batch_start" class="invalid-feedback"></span>
                                        @if ($errors->has('batch_start'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('batch_start') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label> -->
                                        <input id="batch_timing_start" type="text" class="{{ $errors->has('batch_timing_start') ? ' is-invalid' : '' }}" name="batch_timing_start" value="" placeholder="Batch timimg start   Example  02:02" required autofocus>
                                        <div class="input-icon"><i class="fa fa-map-pin"></i></div>
                                        <span id="errors-batch_timing_start" class="invalid-feedback"></span>
                                        @if ($errors->has('batch_timing_start'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('batch_timing_start') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label> -->
                                        <input id="batch_timing_end" type="text" class="{{ $errors->has('batch_timing_end') ? ' is-invalid' : '' }}" name="batch_timing_end" value="" placeholder="Batch timimg end   Example  02:02" required autofocus>
                                        <div class="input-icon"><i class="fa fa-map-pin"></i></div>
                                        <span id="errors-batch_timing_end" class="invalid-feedback"></span>
                                        @if ($errors->has('batch_timing_end'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('batch_timing_end') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                
                    <div class="col-xs-12 col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary">
                    {{ __('Send Request') }}
                    </button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	function validateData() {
		// var batch_start = $('#batch_start').val();
		var batch_timing_start = $('#batch_timing_start').val();
		var batch_timing_end = $('#batch_timing_end').val();

		// if (!ValidateDate(batch_start)) {
		// 	$('#errors-batch_start').html('Invalid Date');
		// 	return false;
		// }
		if (!ValidateTime(batch_timing_start)) {
			$('#errors-batch_timing_start').html('Invalid Time');
			return false;
		}
		if (!ValidateTime(batch_timing_end)) {
			$('#errors-batch_timing_end').html('Invalid Time');
			return false;
		}
		
	}

	$(document).ready(function() {

	});
</script>
@stop
