@extends('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
	<div class="pageTitle">{{ __('Profile') }}</div>
</header>
@endsection
@section('content')


<div class="card mb15">
	<div class="card-body">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="studentImg">
					<img src="" alt="image">
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 studentInfo">
				<p><strong>Name : </strong>{{$user->name}} </p>
				<p><strong>Email :</strong> {{$user->email}}</p> 
				<p><strong>Phone : </strong>{{$user->phone}}</p>
				<p><strong>Address :</strong> {{$user->address}} </p>
				<p><strong>City :</strong> {{$user->city}} </p>
				<p><strong>State :</strong> {{$user->state}}</p> 
				<p><strong>Postal Code :</strong> {{$user->postal_code}}</p> 
				<p><strong>Status :</strong> {{$user->is_info_filled ? 'Filled' : 'Pending'}}</p>
			</div>
		</div>
	</div>
</div>
			@if(!$user->is_info_filled)
				<a href="{{url('/franchise-info-form')}}"> Fill Your info to start as Franchise</a>
		

	@endif

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@stop