@extends('layouts.loginreg') @section('content')
<?php
$query_string2 = ['tab', 'login'];
if (!empty($_SERVER['QUERY_STRING'])) {
  $query_string2 = explode('=', $_SERVER['QUERY_STRING']);
}
//print_r($query_string2);
?>
    <div class="tab-pane {{$query_string2[1] == 'login'?'active show':''}}" id="LoginDiv">
        <div class="card-body" style="max-width:400px;">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="login-title">Welcome Back</h2>
                </div>
            </div>
            <form method="POST" class="form-group" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="formControl">
                            <!--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->
                            <input type="email" placeholder="Email Address/Username" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-icon"><i class="fa fa-user"></i></div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span> @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="formControl">
                            <!--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->
                            <input type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            <div class="input-icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span> @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="formControl">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Login') }}
                        </button>
                        <div class="forgotPass">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                        </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tab-pane {{$query_string2[1] == 'register'?'active show':''}}" id="RegisterDiv">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="login-title">Create an Account</h2>
                    <p class="fieldsetTitle">Personal Details</p>
                </div>
            </div>
            <form method="POST" class="form-group" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                            <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                            <div class="input-icon"><i class="fa fa-user"></i></div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                        </span> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                        <div class="formControl">
                            <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required>
                            <div class="input-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <span id="email_error" class="invalid-feedback" role="alert" style="display:block!important;"></span> @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <!-- <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label> -->
                            <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone" required autofocus>
                            <div class="input-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <span id="phone_error" class="invalid-feedback" role="alert" style="display:block!important;"></span> @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                        </span> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            <div class="input-icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                        </span> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->
                            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <div class="input-icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr/>
                        <p class="fieldsetTitle">Center Details</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label> -->
                            <input id="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Center Address" required autofocus>
                            <div class="input-icon"><i class="fa fa-address-card" aria-hidden="true"></i></div>
                            @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                        </span> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <!-- <label for="state">{{ __('State') }}</label> -->
                            <?php $states = getStates(); ?>
                            <select id="state" autocomplete="off" name="state" required>
                                <option value="">--Please Select State--</option>
                                @foreach($states as $state)
                                <option value="{{$state->state}}">{{$state->state}}</option>
                                @endforeach
                            </select>
                            <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6" id="cityInput" >
                        <div class="formControl">
                            <!-- <label for="city">{{ __('City') }}</label> -->
                            <select id="city" autocomplete="off" name="city" required="" placeholder="City" disabled="true"></select>
                            <div class="input-icon"><i class="fa fa-building" aria-hidden="true"></i>
                            </div>
                            @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                        </span> @endif
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
                                        </span> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <input type="checkbox" class="regchk checkbox" id="online_courses" name="online_courses" value="1">
                            <label for="online_courses">I will Setup Online Only</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="formControl">
                            <input type="checkbox" class="regchk checkbox" id="offline_courses" name="offline_courses" value="1">
                            <label class="col-form-label" for="offline_courses">I will Setup Pendrive/Offline/DTH</label>
                            <div id="chkboxerror" class="invalid-feedback" role="alert" style="display:block!important;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="formControl">
                    <button type="submit" id="register" class="btn btn-block btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @endsection @section('scripts')
    <script src="http://35.200.253.76/js/radix.js" type="text/javascript"></script>
    <script type="text/javascript">
    function getCityState(state) {
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: "/get-city-state",
            data: { _token: "{{csrf_token()}}", state: state },
            async: true,
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
            $("#city").removeAttr( "disabled" )
        });


        $("#register").click(function() {
            var fields = $(".regchk").serializeArray();
            if (fields.length === 0) {
                //alert('nothing selected'); 
                $("#chkboxerror").html("Please check atleast one checkbox");
                // cancel submit
                return false;
            } else {
                $("#chkboxerror").html("");
                return true;
            }

        });



        $("#online_courses").change(function() {
            var fields = $(".regchk").serializeArray();
            if (fields.length === 0) {
                //alert('nothing selected'); 
                $("#chkboxerror").html("Please check atleast one checkbox");
                // cancel submit
                return false;
            } else {
                $("#chkboxerror").html("");
                return true;
            }

        });
        $("#offline_courses").change(function() {
            var fields = $(".regchk").serializeArray();
            if (fields.length === 0) {
                //alert('nothing selected'); 
                $("#chkboxerror").html("Please check atleat one setup.");
                // cancel submit
                return false;
            } else {
                $("#chkboxerror").html("");
                return true;
            }

        });
    });
    </script>
    @stop