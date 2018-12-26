@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
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
            <div class="row formControl">
                    <div class="col-xs-12 col-sm-6">
                        <input id="field1" type="text" class="form-control" name="field1" value="field1" placeholder="Field 1"> 
                        <span id="error-field1" class="invalid-feedback"></span>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input id="field2" type="text" class="form-control" name="field2" value="field2" placeholder="Field 2"> 
                        <span id="error-field2" class="invalid-feedback"></span>
                    </div>
            </div>
            <div class="row formControl">
                    <div class="col-xs-12 col-sm-6">
                        <input id="field3" type="text" class="form-control" name="field3" value="field3" placeholder="Field 3"> 
                        <span id="error-field3" class="invalid-feedback"></span>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input id="field4" type="text" class="form-control" name="field4" value="field4" placeholder="Field 4"> 
                        <span id="error-field4" class="invalid-feedback"></span>
                    </div>
            </div>
            <div class="row formControl">
                    <div class="col-xs-12 col-sm-6">
                        <input id="start_date" type="text" class="form-control" name="start_date" placeholder="Start Date YYYY-MM-DD"> 
                        <span id="error-start_date" class="invalid-feedback"></span>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input id="end_date" type="text" class="form-control" name="end_date" placeholder="End Date YYYY-MM-DD"> 
                        <span id="error-end_date" class="invalid-feedback"></span>
                    </div>
            </div>

            <div class="row formControl">
                <div class="col-xs-12 col-sm-12">
                    <button id="submit" type="submit" class="btn btn-secondary pull-right">
                        {{ __('Generate') }}
                    </button>
                </div>
            </div>
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
        var field1     = $('#field1').val();
        var field2     = $('#field2').val();
        var field3     = $('#field3').val();
        var field4     = $('#field4').val();
        var start_date = $('#start_date').val();
        var end_date   = $('#end_date').val();

        if (!ValidateDate(start_date) ) {
            $('#error-start_date').html('Invalid Date');
            return false;
        }
        if (!ValidateDate(end_date) ) {
            $('#error-end_date').html('Invalid Date');
            return false;
        }
        var _data = {_token:"{{csrf_token()}}", field1:field1, field2:field2, field3:field3, field4:field4,start_date:start_date, end_date:end_date};
        console.log(_data);
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: '/generate-report',
            data: _data,
            async : true,
            success: function(res) {
                // console.log(res);
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