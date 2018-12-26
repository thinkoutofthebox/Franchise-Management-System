@extends ('layouts.franchise')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
   <link href="{{asset('css/studentRegister.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{$student->name }}</div>
</header>
@endsection  
@section ('content')
            <input type="hidden" name="student_id" id="student_id" value="{{$student->id}}">
<div class="row form-group">
        <div class="form-group col-xs-6 col-sm-12 pull-right formControl">
            <div class="radioGroup">
                <div class="radio-item">
                    <input type="radio" id="class_type_paid" name="class_type" value="paid" checked="checked">
                    <label for="class_type_paid">Register for Paid Classes</label>
                </div>
                <div class="radio-item">
                    <input type="radio" id="class_type_demo" name="class_type" value="demo">
                    <label for="class_type_demo">Take a Demo Class</label>
                </div>
            </div>
        </div>
</div>

 

    <div id="load-product-form"></div>
@endsection
@section('scripts')
<script type="text/javascript">
    function loadForm() {
        var class_type = $('input[type="radio"][name="class_type"]:checked').val();
        var student_id = $('#student_id').val();
        console.log(class_type);
        var _data = {_token:"{{csrf_token()}}", class_type:class_type, student_id:student_id};
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: '/load-form',
            data: _data,
            async : true,
            success: function(res) {
                $('#load-product-form').html(res);
                $('.loading').hide();
            },

            error: function(error) {
                console.log(error);
            }
        });
    }
    loadForm();
    $('input[type="radio"][name="class_type"]').on('click', function(){
        loadForm();
    });
</script>
@stop