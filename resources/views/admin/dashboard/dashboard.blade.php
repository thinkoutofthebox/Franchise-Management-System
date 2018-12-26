@extends('layouts.admin')
@section('styles')
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet" />
@stop
@section('content')
<div class="welcomeHeader">
	<div class="welcomeBanner">
		<h3>Hi Admin! <br/>Welcome to Dashboard!</h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<div class="stepsLinks">
			<a href="{{url('/franchise-list')}}">	
				<span class="btn btn-app btn-sm btn-primary no-hover">
					<span class="line-height-1 bigger-170"> {{$franchises}} </span>
					<br>
					<span class="line-height-1 smaller-90"> Franchise Requests </span>
				</span>
			</a>
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
