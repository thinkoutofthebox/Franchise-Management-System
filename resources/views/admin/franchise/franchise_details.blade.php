@extends ('layouts.admin')

@section('styles')
	<link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{ __('Franchise Profile') }}</div>
</header>
@endsection	
@section ('content')
<!-- <div class="clearfix">
	<a href="{{url('/edit-franchise-profile/'.$franchise->id)}}"  class="btn btn-link pull-right">Edit Profile</a>
</div> -->
<div class="card mb15">
	<div class="card-body">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="studentImg">
					<img src="" alt="image">
				</div>
			</div>
		<div class="col-xs-12 col-sm-8 studentInfo">
			<p><strong>Name:</strong> {{$franchise->name}}</p> 
			<p><strong>Email: </strong>{{$franchise->email}}</p> 
			<p><strong>Phone:</strong> {{$franchise->phone}}</p> 
			<p><strong>Address:</strong> {{$franchise->address}}</p> 
			<p><strong>City:</strong> {{$franchise->city}}</p> 
			<p><strong>State:</strong> {{$franchise->state}}</p> 
			<p><strong>Postal Code:</strong> {{$franchise->postal_code}}</p> 
			<!-- <pre><?php print_r($franchise->franchise_info) ?></pre> -->
		</div>
		
		</div>
	</div>
</div>
			@endsection
				@section('scripts')
					<script type="text/javascript">
	
					</script>
						@stop