@extends('layouts.loginreg') 
@section('content')
<div class="card-body">
    <div class="row">
	<div class="col-sm-12">
		<h2 class="login-title">Create an Account</h2>
	</div>
    </div>
    <form method="POST" class="form-group" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf
	<div class="row">
		<div class="col-xs-12 col-sm-6">
        		<div class="formControl">
				<!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
            			<input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
            			<div class="input-icon"><i class="fa fa-user"></i></div>
            			@if ($errors->has('name'))
            				<span class="invalid-feedback" role="alert">
                                        	<strong>{{ $errors->first('name') }}</strong>
                                    	</span> 
				@endif
        		</div>
		</div>
		<div class="col-xs-12 col-sm-6">
        		<!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
        		<div class="formControl">
            			<input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
            			<div class="input-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
            			@if ($errors->has('email'))
            				<span class="invalid-feedback" role="alert">
                                        	<strong>{{ $errors->first('email') }}</strong>
                                    	</span> 
				@endif
			</div>
		</div>
                <div class="col-xs-12 col-sm-6">
        		<div class="formControl">
            			<!-- <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label> -->
            			<input id="phone" type="text" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone" required autofocus>
            			<div class="input-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            			@if ($errors->has('phone'))
            				<span class="invalid-feedback" role="alert">
                                    		<strong>{{ $errors->first('phone') }}</strong>
                                	</span> 
				@endif
			</div>
        	</div>
		<div class="col-xs-12 col-sm-6">
        		<div class="formControl">
            			<!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label> -->
            			<input id="address" type="text" class="{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address" required autofocus>
            			<div class="input-icon"><i class="fa fa-address-card" aria-hidden="true"></i></div>
            			@if ($errors->has('address'))
            				<span class="invalid-feedback" role="alert">
                                    		<strong>{{ $errors->first('address') }}</strong>
                                	</span> 
				@endif
			</div>
		</div>
                <div class="col-xs-12 col-sm-6">
        		<div class="formControl">
            			<!-- <label for="state">{{ __('State') }}</label> -->
            			<?php $states = getStates(); ?>
            			<select id="state" autocomplete="off" name="state" required>
                			<option value="">--Please Select--</option>
                			@foreach($states as $state)
                			<option value="{{$state->state}}">{{$state->state}}</option>
                			@endforeach
            			</select>
            			<div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
			</div>
		</div>
                <div class="col-xs-12 col-sm-6" id="cityInput" style="display:none">
        		<div class="formControl">
            			<!-- <label for="city">{{ __('City') }}</label> -->
            			<select id="city" autocomplete="off" name="city" required="" placeholder="City"></select>
            			<div class="input-icon"><i class="fa fa-building" aria-hidden="true"></i>
            			</div>
            			@if ($errors->has('city'))
            				<span class="invalid-feedback" role="alert">
                                    		<strong>{{ $errors->first('city') }}</strong>
                                	</span> 
				@endif
			</div>
		</div>
                <div class="col-xs-12 col-sm-6">
        		<div class="formControl">
            			<!-- <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label> -->
            			<input id="postal_code" type="text" class="{{ $errors->has('state') ? ' is-invalid' : '' }}" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal Code" required autofocus>
            			<div class="input-icon"><i class="fa fa-map-pin" aria-hidden="true"></i></div>
            			@if ($errors->has('postal_code'))
            				<span class="invalid-feedback" role="alert">
                                    		<strong>{{ $errors->first('postal_code') }}</strong>
                                	</span>
				 @endif
			</div>
        	</div>
                <div class="col-xs-12 col-sm-6">
			<div class="formControl">
            			<!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
            			<input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
            			<div class="input-icon"><i class="fa fa-key" aria-hidden="true"></i></div>
            			@if ($errors->has('password'))
            				<span class="invalid-feedback" role="alert">
                                   		<strong>{{ $errors->first('password') }}</strong>
                                	</span> 
				@endif
			</div>
		</div>
                <div class="col-xs-12 col-sm-6">
        		<div class="formControl">
            			<!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->
            			<input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required>
            			<div class="input-icon"><i class="fa fa-key" aria-hidden="true"></i></div>
			</div>
        	</div>
		<div class="col-xs-12 col-sm-6">
        		<div class="formControl">
            			<input type="checkbox" id="online_courses" name="online_courses" value="1">
            			<label for="online_courses">I will Setup ELC</label>
			</div>
		</div>
        </div>
        <div class="formControl">
            <input type="checkbox" class="checkbox" id="offline_courses" name="offline_courses" value="1">
            <label class="col-form-label" for="offline_courses">I will Setup Pendrive/Offline/DTH</label>
        </div>
        <div id="chkboxerror" class="invalid-feedback" role="alert">
                            </div>
        <div class="formControl">
            <button type="submit" id="register" class="btn btn-block btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
</div>
@endsection @section('scripts')
<script type="text/javascript">
function getCityState(state) {
    $('.loading').show();
    $.ajax({
        type: 'POST',
        url: "/get-city-state",
        data: { _token: "{{csrf_token()}}", state: state },
        async : true,
        success: function(res) {
            console.log(res);
            $('#city').html(res);
            $('.loading').hide();
        },

        error: function(error) {
            console.log(error);
        }
    });
}

$(document).ready(function() {
    console.log('ok');
    $('#state').on('change', function() {
        var state = $('#state option:selected').val();
        console.log(state);
        getCityState(state);
	$("#cityInput").show();

    });


    $("#register").click(function() {

  alert("Please check atleast one checkbox");
        if (
            ($('input[name="online_courses"]:checked').length == "0") &&
            ($('input[name="offline_courses"]:checked').length == "0")
        )

        {   alert("Please check atleast one checkbox");
            $("#chkboxerror").html("Please check atleast one checkbox");
            return false;
        } else {
            $("#chkboxerror").html("");
            return true;
        }

    });


});
</script>
@stop
