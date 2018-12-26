@extends ('layouts.app')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{ __('Franchise List') }}</div>
</header>
@endsection 
    
@section ('content')
<div class="card">
    <div id="BasicDetails">
        <div class="card-body">
            <form method="POST" class="form-group" action="{{url('/save-lead')}}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                                    <span id="error-name" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-user"></i></div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                                <div class="formControl">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                    <span id="error-email" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label> -->
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <input id="phone" type="text" name="phone" value="{{ old('postal_code') }}" placeholder="Phone" required />
                                    <span id="error-phone" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label> -->
                                    <input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                    <span id="error-address" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label> -->
                                    <input id="postal_code" type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal Code" required autofocus>
                                    <span id="error-postal_code" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-map-pin" aria-hidden="true"></i></div>
                                    @if ($errors->has('postal_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                    <input id="father_name" type="text" name="father_name" value="{{ old('father_name') }}" placeholder="Father Name" required autofocus>
                                    <span id="error-father_name" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-user"></i></div>
                                    @if ($errors->has('father_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('father_name') }}</strong>
                                        </span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <select id="pid" autocomplete="off" name="pid" required>
                                        <option value="">--Select Course--</option>
                                        @foreach($products as $product)
                                        <option data-min_fee_allowed="{{$product->min_fee_allowed}}" data-max_fee_allowed="{{$product->max_fee_allowed}}" data-min_fee_books_services="{{$product->min_fee_books_services}}" value="{{$product->pid.'_'.$product->product_name}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="col-xs-12 col-sm-12">
                            <label class="radio-inline"><input type="radio" name="category" checked value="gen"> Gen </label>
                            <label class="radio-inline"><input type="radio" name="category" value="sc"> SC </label>
                            <label class="radio-inline"><input type="radio" name="category" value="st"> ST </label>
                            <label class="radio-inline"><input type="radio" name="category" value="obc"> OBC </label>
                        </div>                       
                        <div class="col-xs-12 col-sm-12">
                            <input type="checkbox" class="regchk checkbox" id="is_muslim" name="is_muslim" value="1"> IsMuslim
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <button type="submit" id="enrol" name="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
      
</script>
@stop