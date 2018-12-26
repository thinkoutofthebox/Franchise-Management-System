@extends ('layouts.franchise')
@section('styles')

   <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
   <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />

@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">
        {{ __('Batch List') }}
    </div>
    <div class="addStudent">
        <a href="{{url('/request-batch')}}" class="btn btn-primary">Request New Batch</a>
    </div>
</header>
@endsection
@section ('content')
<div class="form-group">
    <div class="formControl noIcon">
        <select id="pid" onchange="ajaxLoad('/load-batch-list')" required style="width: auto;">
            <option value="">---Please Select Product---</option>
            @foreach($products as $product)
            <option value="{{$product->pid}}">{{$product->product_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="card">
    <div class="card-body">
            <div id="batch-list"></div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
     function ajaxLoad(url_path) {
        var pid = $('#pid option:selected').val();
        console.log(pid);
        var _data = {_token:"{{csrf_token()}}", pid:pid}
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
    $(document).ready(function () {
        var url_path = '/load-batch-list';
        ajaxLoad(url_path);
    }); 
</script>
@stop
