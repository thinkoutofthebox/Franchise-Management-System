@extends ('layouts.admin')
@section('styles')

   <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
   <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />

@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">
        {{ __('Batch List') }}
    </div>
</header>
@endsection
@section ('content')
@if($franchises->count() > 0)
<div class="form-group">
    <div class="formControl noIcon">
        <select id="elc_id" required style="width: auto;">
            <option value="">---Please Select Franchise---</option>
            @foreach($franchises as $franchise)
                <option value="{{$franchise->id}}">{{$franchise->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group" id="productInput" style="display:none">
    <div class="formControl">
           <select id="pid" autocomplete="off" name="pid" required>

            </select>
        <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
            <div id="batch-list"></div>
    </div>
</div>
@else
<div class="no-found"> 
    <div class="icon-wrapper">
      <img src="{{asset('images/no-user-icon.svg')}}" alt="No Student Found" />
    </div>
    <h4>No Records Found</h4>
</div>
@endif
@endsection

@section('scripts')
<script type="text/javascript">
    function getProductBatches(elc_id) {
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: "/get-product-elc",
            data: { _token: "{{csrf_token()}}", elc_id: elc_id },
            async : true,
            success: function(res) {
                console.log(res);
                $('#pid').html(res);
                $('.loading').hide();
            },

            error: function(error) {
                console.log(error);
            }
        });
    }

     function ajaxLoad(url_path) {
        var elc_id = $('#elc_id option:selected').val();
        var pid = $('#pid option:selected').val();
        var _data = {_token:"{{csrf_token()}}", elc_id:elc_id, pid:pid}
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: url_path,
            data:_data,
            success: function(res) { 
                $('#batch-list').html(res);
                $('.loading').hide();
            },

            error: function(error){
                console.log(error);
            }
        });

    }

    $(document).ready(function() {
        console.log('ok');
        $('#elc_id').on('change', function() {
            var elc_id = $('#elc_id option:selected').val();
            console.log(elc_id);
            getProductBatches(elc_id);
            $("#productInput").show();

        });
        $('#pid').on('change', function() {
            var pid = $('#pid option:selected').val();
            console.log(pid);
            ajaxLoad('/admin-load-batch-list');
            $("#productInput").show();

        });    
     });
</script>
@stop
