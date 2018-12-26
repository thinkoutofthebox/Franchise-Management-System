@extends ('layouts.franchise')
@section('styles')

   <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />


@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">
		{{ __('Student List') }}
	</div>
	<div class="addStudent">
		<a href="{{url('/student-registration-form')}}" class="btn btn-primary">Add New Student</a>
	</div>
</header>
@endsection
@section ('content')
<div class="card filter mb15">
        <div class="filter-item-pad st-phone-input" style="flex:100%;">
        	<div class="filterFormInput">
			<input id="search" class="form-control" onkeyup="if ((event.which<=90 && event.which>=48) || event.keyCode==8 ||event.keyCode==46 ||event.keyCode==13) ajaxLoad('{{url('/load-students-list')}}?search='+this.value)" placeholder="Search student by their Name/email/phone no." type="text" >
            		<div class="input-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>
        </div>
</div>	
<div class="card">
	<div class="card-body">
    		<div id="students-list">	</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
     function ajaxLoad(url_path) {
        $('.loading').show();
        $.ajax({
            type: 'GET',
            url: url_path,
            success: function(res) { 
                $('#students-list').html(res);
                $('.loading').hide();
            },

            error: function(error){
                console.log(error);
            }
        });

    }
    $(document).ready(function () {
        var url_path = '/load-students-list';
        ajaxLoad(url_path);
    }); 
</script>
@stop
