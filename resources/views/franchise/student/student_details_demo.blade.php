@extends ('layouts.franchise')

@section('styles')
	 <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
	<link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{ __('Student Profile') }}</div>
	<div class="addStudent">
               <a href="{{url('/new-product-form/'.$student->id)}}" class="btn btn-primary">Add New Course</a>
        </div>
</header>
@endsection	
@section ('content')
<div class="clearfix">
	<a href="{{url('/edit-student-profile/'.$student->id)}}" class="btn btn-link pull-right">Edit Profile</a>
</div>
<div class="card mb15">
	<div class="card-body">
		@if(isset($student->image))
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="studentImg">
					<img src="{{$student->image}}" alt="{{$student->name}}">
				</div>
			</div>
			@endif
			<div class="col-xs-12 col-sm-8 studentInfo">
				<p><strong>Name:</strong> {{$student->name}}</p>
				<p><strong>Father Name:</strong> {{$student->father_name}} </p>
				<p><strong>Email:</strong> {{$student->email}}  </p>
				<p><strong>Phone:</strong> {{$student->phone}} </p>
				<p><strong>Address:</strong> {{$student->address}} </p>
				<p><strong>Postal Code:</strong> {{$student->postal_code}} </p>
				<hr/>
				<div class="referralNumb">
                			Referred By the Student: 
				        @if($student->referred_phones->count() > 0)
					        @foreach($student->referred_phones as $phone)
				        	        <span><a href="tel:{{$phone->phone_number}}" class="btn btn-link">{{$phone->phone_number}}</a></span>
				                @endforeach
				        @else
					        No Referred Numbers
				        @endif
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card mb15">
        <div class="card-body">
		<h3 class="section-title">Alloted Courses</h3>
		<table class="table">
			<tr>
				<th width="10%">Class Type</th>
				<th width="20%">Product Name</th>
				<th width="10%">Net Amount</th>
				<th width="10%">Fee Paid</th>
				<th width="10%">Balance Due</th>
				<th width="20%">Demo</th>
			</tr>
			@foreach($student->products as $product)
			@if($product->class_type == 'lead')
			<tr>
				<td>{{ucwords($product->class_type)}}</td>
				<td>{{$product->product->product_name}}</td>
				<td><i class="fa fa-rupee"></i> {{$product->net_due}}</td>
				<td><i class="fa fa-rupee"></i> {{$product->amount_paid}}</td>
				<td><i class="fa fa-rupee"></i> {{$product->balance_amount}}</td>
				<td>
				@if(!$product->is_fee_submitted)
				<a href="{{url('/demo-class-form' .'/'.$student->id .'/'.$product->id)}}" class="btn btn-default">Take Demo</a>
				@endif
				</td>
			</tr>
			@endif
			@endforeach
		</table>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Has the Student really left the Course? This event is irreversible.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	function courseLeft(){
		var product_id = $('input[type="radio"][name="status"]:checked').data('product_id');
		var status = $('input[type="radio"][name="status"'+product_id+']:checked').val();
		var _data = {_token:"{{csrf_token()}}", product_id:product_id, status:status};
		$('.loading').show();
		$.ajax({
            type: 'POST',
            url: '/course-left',
            data: _data,
            async : true,
            success: function(res) {
                console.log(res);
                alert(res);
                $('.loading').hide();
            },

            error: function(error) {
                console.log(error);
            }
        });
	}

	$('input[type="radio"][name="status"]').on('click', function(){
		var val = $('input[type="radio"][name="status"]:checked').val();
		if (val == 'active') {
			$('input[type="radio"][name="status"]').first().prop('disabled');
			return;
		}
		var product_id = $('input[type="radio"][name="status"]:checked').data('product_id');
		var check = confirm('Has the Student really left the Course? This event is irreversible.');
		if (check) {
			courseLeft();
		}
	});

</script>
@stop
