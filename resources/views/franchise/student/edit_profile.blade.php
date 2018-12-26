@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
    <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{'Edit Student Profile'}}</div>
	<div class="addStudent">
               <a href="{{url('/student-details'.'/'.$student->id)}}" class="btn btn-link"><i class="fa fa-arrow-left"></i> Back to student profile</a>
        </div>
</header>
@endsection 
@section('content')

<pre><?php  //print_r($student);
//print_r($referred_phones);

?></pre>
<div class="card">
    <div id="BasicDetails">
        <div class="card-body">
                <form method="POST" class="form-group" action="{{ url('update-student-details') }}">
                    @csrf
                            <input id="id" type="hidden"  name="id" value="{{$student->id}}" placeholder="">

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$student->name}}" placeholder="Full Name" required autofocus>
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
                                        <!-- <label for="father_name" class="col-md-4 col-form-label text-md-right">{{ __('father_name') }}</label> -->
                                        <input id="father_name" type="text" class="form-control {{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{$student->father_name}}" placeholder="Full Father's name" required autofocus>
                                        <div class="input-icon"><i class="fa fa-user"></i></div>
                                        @if ($errors->has('father_name'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('father_name') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-6">
                                <div class="formControl">
                                        <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label> -->
                                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$student->email}}" placeholder="Email" required autofocus>
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
                                        <input id="phone" type="text" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $student->phone }}" placeholder="Full phone" required readonly autofocus>
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
                                        <input id="address" type="text" class="{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$student->address}}" placeholder="Full address" required autofocus>
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
                                        <!-- <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('postal_code') }}</label> -->
                                        <input id="postal_code" type="text" class="{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{$student->postal_code}}" placeholder="Full postal_code" required autofocus>
                                        <div class="input-icon"><i class="fa fa-map-marker"></i></div>
                                        @if ($errors->has('postal_code'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                                </span>
                                        @endif
                                </div>
                            </div>
                            <?php  $i=0; foreach($referred_phones as $values){$stu_ref=json_decode($values,TRUE); $i++;?>    
                            <div class="col-xs-12 col-sm-6">     
                                <div class="formControl noIcon">
                                <input type="text"  readonly placeholder="Reference Phone"  value="{{$stu_ref['phone_number']}}">
                                </div>
                            </div>
                        <?php } $k=5-$i;  if($k>0){for($j=1; $j<=$k; $j++){?>
						<div class="col-xs-12 col-sm-6">     
							<div class="formControl noIcon">
							<input type="text" name="referred_phone[]" placeholder="Reference Phone" value="">
							</div>
						</div>	
						<?php } }   ?>
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

@stop
