@extends('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
	<div class="pageTitle">{{ __('Franchise Info') }}</div>
</header>
@endsection
@section('content')
            <div class="card">
                <div class="card-body">
                    <form  method="POST" class="form-group" action="{{ url('save-franchise-info') }}" aria-label="{{ __('Franchise Info') }}" onsubmit="return checkCourese()">
                        @csrf
			<div class="row">
                        	<div class="formControl clearfix">
					<div class="col-xs-12 col-sm-6">		
                        			<label for="is_existing_elc" class="labelText">{{ __('Are You running an Existing ELC ?') }}</label>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="radioGroup">
							<div class="radio-item">
								<input id="is_existing_elc_yes" type="radio" name="is_existing_elc" value="1" checked>
								<label for="is_existing_elc_yes">Yes</label>
							</div>
							<div class="radio-item">
								<input id="is_existing_elc_no"type="radio" name="is_existing_elc" value="0">
								<label for="is_existing_elc_no">No</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="elc_running_years_div">
				<div class="formControl">
					<div class="col-xs-12 col-sm-6">
                        			<div>
                            				<label for="elc_running_years" class="">{{ __('Running From Last') }}</label>
						</div>
					</div>
                            		<div class="col-xs-12 col-sm-6">
                                		<input id="elc_running_years" type="number" class="form-control{{ $errors->has('elc_running_years') ? ' is-invalid' : '' }}" name="elc_running_years" value="{{ old('elc_running_years') }}">
			         			@if ($errors->has('elc_running_years'))
                                    				<span class="invalid-feedback" role="alert">
				                                        <strong>{{ $errors->first('elc_running_years') }}</strong>
                                				</span>
                                			@endif
                                			<span class="valueUnit">in yrs.</span>
                            		</div>
				</div>
                        </div>
			<div class="row">
                                <div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
                            			<label for="is_premise_owned" class="">{{ __('Is the Premise Owned?') }}</label>
					</div>
					 <div class="col-xs-12 col-sm-6">
                                                <div class="radioGroup">
                                                        <div class="radio-item">
                              					<input type="radio" id="is_premise_owned_yes" name="is_premise_owned" value="1" checked>
                            					<label for="is_premise_owned_yes">Yes</label>
							</div>
							<div class="radio-item">
                              					<input type="radio" id="is_premise_owned_no" name="is_premise_owned" value="0">
                            					<label for="is_premise_owned_no">No</label>
							</div>
						</div>
					</div>
				</div>
                        </div>
                        <div class="row">
				<div class="formControl">
                                        <div class="col-xs-12 col-sm-6">	
                            			<label for="premise_area" class="">{{ __('Area of Premise') }}</label>
					</div>
                            		<div class="col-xs-12 col-sm-6">
                                		<input id="premise_area" type="number" class="form-control{{ $errors->has('premise_area') ? ' is-invalid' : '' }}" name="premise_area" value="{{ old('premise_area') }}" required>
                                		@if ($errors->has('premise_area'))
                                    			<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $errors->first('premise_area') }}</strong>
                                    			</span>
                                		@endif
                                		<span class="valueUnit">in sqft.</span>
                            		</div>
				</div>
                        </div>
                        <div class="row">
				<div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
                            			<label for="franchise_profile" class="">{{ __('Background Profile of the Franchise') }}</label>
					</div>
                            		<div class="col-xs-12 col-sm-6">
                                		<textarea id="franchise_profile" class="form-control{{ $errors->has('franchise_profile') ? ' is-invalid' : '' }}" name="franchise_profile" value="{{ old('franchise_profile') }}" rows="3" maxlength="200"></textarea>
                                		@if ($errors->has('franchise_profile'))
                                    			<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $errors->first('franchise_profile') }}</strong>
                                    			</span>
                                		@endif
                            		</div>
				</div>
                        </div>
			<div class="row">
                                <div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
                            			<label for="investment_budget" class="">{{ __('Investment Budget') }}</label>
					</div>
					<div class="col-xs-12 col-sm-6">
                                                <div class="radioGroup">
							<div class="radio-item">
						      		<input type="radio" id="zero_investment_budget" name="investment_budget" value="3" checked>
								<label for="zero_investment_budget">3 Lakhs</label>
							</div>
							<div class="radio-item">
						      		<input type="radio" id="one_investment_budget" name="investment_budget" value="5">
								<label for="one_investment_budget">upto 5 Lakhs</label>
							</div>
							<div class="radio-item">
						      		<input type="radio" id="two_investment_budget" name="investment_budget" value="10">
								<label for="two_investment_budget">upto 10 Lakhs</label>
							</div>
						</div>
					</div>
				</div>
                        </div>
                        <div class="row">
				<div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
                            			<label for="courses[]" class="">{{ __('Courses You are looking for') }}</label>
					</div>
                    <?php $courses = getCourses();?>
					<div class="col-xs-12 col-sm-6">
	                        		<div class="formControl">
                                        @foreach($courses as $course)
            							<input type="checkbox" id="{{$course->id}}" name="courses[]" value="{{$course->course_name}}">
            							<label for="{{$course->id}}">{{$course->course_name}}</label>
                                        <img src="{{ asset('images/'.$course->logo_path) }}" alt="{{$course->course_name}}">
                                        @endforeach
						</div>
                            			<span id="courseerror" class="invalid-feedback" role="alert" >
                           			</span>
					</div>
				</div>
			</div>

						<!-- <div class="form-group row">
                        	<label for="premise" class="col-md-4 col-form-label text-md-right">{{ __('Has the premised for rent under possession?') }}</label>

                        	<label class="radio-inline">
						      <input type="radio" name="premise" value="1" checked>Yes
						    </label>
						    <label class="radio-inline">
						      <input type="radio" name="premise" value="0">No
						    </label>
                        </div> -->
                        <div class="row">
				<div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
                            			<label for="days_req" class="">{{ __('Tentative Days required for you to make operational') }}</label>
					</div>
					 <div class="col-xs-12 col-sm-6">
                                		<input id="days_req" type="number" class="form-control{{ $errors->has('days_req') ? ' is-invalid' : '' }}" name="days_req" value="{{ old('days_req') }}" min="1" required autofocus>
                               			@if ($errors->has('days_req'))
                                    			<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $errors->first('days_req') }}</strong>
                                    			</span>
                                		@endif
                                		<span class="valueUnit">in days.</span>
					</div>
                            	</div>
                        </div>
			<div class="row">
                                <div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
					</div>
					<div class="col-xs-12 col-sm-6">
                            			<input type="checkbox" name="has_plan" value="0" id="has_plan">
						<label class="radio-inline" for="has_plan" class="">{{ __('I have no business plan in mind as of now') }}</label>
					</div>
				</div>
			</div>
                        <div id="franchise_plan_div"  class="row">
				<div class="formControl">
                                        <div class="col-xs-12 col-sm-6">
                            			<label for="franchise_plan" class="">{{ __('Your 1 year targets and Business plan for the selected courses') }}</label>
					</div>
					<div class="col-xs-12 col-sm-6">
                                		<textarea id="franchise_plan" type="textarea" class="form-control{{ $errors->has('franchise_plan') ? ' is-invalid' : '' }}" name="franchise_plan" value="{{ old('franchise_plan') }}" rows="3" required></textarea>
                                		@if ($errors->has('franchise_plan'))
                                    			<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $errors->first('franchise_plan') }}</strong>
                                    			</span>
                                		@endif
					</div>
                            	</div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-secondary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
     
@endsection

@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {

     $("input[name=is_existing_elc]:radio").click(function () {
        if ($('input[name=is_existing_elc]:checked').val() == "1") {
            $("#elc_running_years_div").show();
            $('input[name=elc_running_years]').prop('required',true);
        } else  {
             $("#elc_running_years_div").hide();
            $('input[name=elc_running_years]').prop('required',false);

        }            
    });


    if ($('input[name=is_existing_elc]:checked').val() == "1") {
        $("#elc_running_years_div").show();
        $('input[name=elc_running_years]').prop('required',true);
    } else  {
        $("#elc_running_years_div").hide();
        $('input[name=elc_running_years]').prop('required',false);

    } 

    $("#submit").click(function(){
        if($('input[name="courses[]"]:checked').length == "0"){
            $("#courseerror").html("Please select atleast one course");
            //alert('Please select atleast one course');
            return false;
        }
        else{ 
                return true;
        }

    });

    $('input[name="has_plan"]').on('click', function(){
        console.log($('input[name="has_plan"]:checked').prop('checked'));
        if ($('input[name="has_plan"]:checked').prop('checked')==true)
        { 
            $('textarea[name="franchise_plan"]').prop('required',false);
            $("#franchise_plan_div").hide();
        }
        else 
        { 
            $("#franchise_plan_div").show();
        }
     });

});

</script>
@stop
