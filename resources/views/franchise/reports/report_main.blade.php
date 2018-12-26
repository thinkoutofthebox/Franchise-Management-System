@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
   <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{__('Report Generation')}}</div>
</header>
@endsection  
@section ('content')
<div class="card">
    <div class="card-body">
        <form class="form-group" onsubmit="return generateReport()">
        	<div class="row" id="elc_running_years_div">
        	    <div class="formControl">
        	        <div class="col-xs-12 col-sm-6">
        	            <input id="start_date" type="text" class="form-control" name="start_date" placeholder="Start Date YYYY-MM-DD"> 
        	            <span id="error-start_date" class="invalid-feedback"></span>
        	        </div>

        	        <div class="col-xs-12 col-sm-6">
        	            <input id="end_date" type="text" class="form-control" name="end_date" placeholder="End Date YYYY-MM-DD"> 
        	            <span id="error-end_date" class="invalid-feedback"></span>
        	        </div>
        	    </div>
        	</div>
			<button type="submit">Generate</button>
		</form>
	</div>
</div>

	<div id="load-dynamic-reports"></div>

@endsection
@section('scripts')
<script type="text/javascript">
     function generateReport() {
        $('#error-start_date').html('');
        $('#error-end_date').html('');
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        if (!ValidateDate(start_date) ) {
            $('#error-start_date').html('Invalid Date');
            return false;
        }
        if (!ValidateDate(end_date) ) {
            $('#error-end_date').html('Invalid Date');
            return false;
        }
        var _data = {_token:"{{csrf_token()}}", start_date:start_date, end_date:end_date};
        console.log(_data);
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: '/generate-report',
            data: _data,
            async : true,
            success: function(res) {
                console.log(res);
                $('#load-dynamic-reports').html(res);
                $('.loading').hide();
            },

            error: function(error) {
                console.log(error);
                $('.loading').hide();
            }
        });
        return false;
    }
</script>
@stop