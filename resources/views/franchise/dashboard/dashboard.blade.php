@extends('layouts.franchise')
@section('styles')
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet" />
@stop
@section('content')
<div class="welcomeHeader">
	<div class="welcomeBanner">
		<h3>Welcome to your Dashboard!</h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<div class="stepsLinks">
			@if(auth()->user()->is_info_filled && is_null(auth()->user()->is_approved))
			<div class="card">
				<div class="card-body">
					<p>Your Application has been submitted and is under review.</p>
				</div>
			</div>
			@endif
			@if(auth()->user()->is_approved === false)
			<div class="card">
				<div class="card-body">
					<p>Your Application has been dis-approved. Please contact our team for more information.</p>
				</div>
			</div>
			@endif
			@if(auth()->user()->is_approved)
			<a href="{{url('/students-list')}}">	
				<span class="btn btn-app btn-sm btn-primary no-hover">
					<span class="line-height-1 bigger-170"> {{$students}} </span>
					<br>
					<span class="line-height-1 smaller-90"> Enrolled Students </span>
				</span>
			</a>
			@endif
		</div>
	</div>
</div>
	

@endsection
@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
    console.log( "ready!" );
});
</script>
@stop
