@extends ('layouts.admin')
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{ __('Franchise List') }}</div>
</header>
@endsection 
	
@section ('content')	
		<span class="input-icon">
            <input id="search" class="form-control" onkeyup="if ((event.which<=90 && event.which>=48) || event.keyCode==8 ||event.keyCode==46 ||event.keyCode==13) ajaxLoad('{{url('/load-franchise-list')}}?search='+this.value)" placeholder="Search..." type="text" >
        </span>

    <div id="franchise-list" style="margin-top: 20px;" class="col-sm-12" >	</div>
@endsection

@section('scripts')
<script type="text/javascript">
     function ajaxLoad(url_path) {
        $('.loading').show();
        $.ajax({
            type: 'GET',
            url: url_path,
            success: function(res) { 
                $('#franchise-list').html(res);
                $('.loading').hide();
            },

            error: function(error){
                console.log(error);
            }
        });

    }
    $(document).ready(function () {
        var url_path = '/load-franchise-list';
        ajaxLoad(url_path);
    }); 
</script>
@stop