@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{'Edit Franchise Profile'}}</div>
</header>
@endsection 
@section('content')

<pre><?php // print_r($franchise_data); 
?></pre>
<div class="card">
    <div id="BasicDetails">
        <div class="card-body">
                <form method="POST" class="form-group" action="{{ url('update-franchise-details') }}">
                    @csrf
                            <input id="id" type="hidden"  name="id" value="{{$franchise_data->id}}" placeholder="">

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$franchise_data->name}}" placeholder="Full Name" required autofocus>
                                        <div class="input-icon"><i class="fa fa-user"></i></div>
                                        @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>

                             <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label> -->
                                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$franchise_data->email}}" placeholder="Email" required readonly autofocus>
                                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                        @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('phone') }}</label> -->
                                        <input id="phone" type="text" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $franchise_data->phone }}" placeholder="Full phone" required readonly autofocus>
                                        <div class="input-icon"><i class="fa fa-phone"></i></div>
                                        @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label> -->
                                        <input id="address" type="text" class="{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$franchise_data->address}}" placeholder="Full address" required autofocus>
                                        <div class="input-icon"><i class="fa fa-map-pin"></i></div>
                                        @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                                <?php $states = getStates(); ?>
                                <select id="state" autocomplete="off" name="state" required>
                                <option value="">--Please Select--</option>
                                @foreach($states as $state)
                                <option value="{{$state->state}}" {{$franchise_data->state == $state->state ? 'selected' : ''}}>{{$state->state}}</option>
                                @endforeach
                                </select>
                                <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            </div>
                        </div>

                         <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('city') }}</label> -->
                                        <select id="city" autocomplete="off" name="city" required="" placeholder="City">
                                            <option value="{{$franchise_data->city}}">{{$franchise_data->city}}</option>
                                        </select>
                                        <div class="input-icon"><i class="fa fa-map-marker"></i></div>
                                        @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('postal_code') }}</label> -->
                                        <input id="postal_code" type="text" class="{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{$franchise_data->postal_code}}" placeholder="Full postal_code" required autofocus>
                                        <div class="input-icon"><i class="fa fa-map-marker"></i></div>
                                        @if ($errors->has('postal_code'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                
                    <div class="col-xs-12 col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary">
                    {{ __('Update') }}
                    </button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
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
        //$("#cityInput").show();

    }); 
}); 
</script>
@stop


