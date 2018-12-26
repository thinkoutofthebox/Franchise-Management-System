<div class="card mb15">
    <div class="card-body">    
        <div class="pull-right"><a href="{{url('/new-product-form/'.$student->id)}}" class="btn btn-primary">Add New Course</a></div>
    @if(isset($student->image))
        <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div>
                <img src="{{$student->image}}" width="20%">
            </div>
        </div>
    @endif
            <div class="col-xs-12 col-sm-8 studentInfo">
                <p><strong>Name:</strong> {{$student->name}}</p> 
                <p><strong>Father Name:</strong> {{$student->father_name}} </p>
                <p><strong>Email:</strong> {{$student->email}} </p>
                <p><strong>Phone:</strong> {{$student->phone}} </p>
                <p><strong>Address:</strong> {{$student->address}} </p>
                <p><strong>Postal Code:</strong> {{$student->postal_code}}</p><hr/>
        <div class="referralNumb">
                Phone Numbers Referred By the Student<br>
                @if($student->referred_phones->count() > 0)
                <
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
<div class="clearfix">
    <a href="{{url('/edit-student-profile/'.$student->id)}}" class="btn btn-link pull-right" >Edit Profile</a>    
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Status</th>
                <th>Class Type</th>
                <th>Product Name</th>
                <th>Net Amount</th>
                <th>Amount Paid</th>
                <th>Balance Amount</th>
                <th>Pay Fee/Demo</th>
            </tr>
            @foreach($student->products as $product)
                <tr>
                    <td>{{strtoupper($product->status)}}</td>
                    <td>{{ucwords($product->class_type)}}</td>
                    <td>{{$product->product->product_name}}</td>
                    <td>{{$product->net_due}}</td>
                    <td>{{$product->amount_paid}}</td>
                    <td>{{$product->balance_amount}}</td>
                    <td>
                    @if($product->class_type == 'demo')
                        <a href="{{url('/student-fee-form' .'/'.$student->id .'/'.$product->id)}}">Pay</a>
                         <br>
                        <a href="{{url('/demo-class-form' .'/'.$student->id .'/'.$product->id)}}">Take Demo</a>
                    @endif
                    @if(!$product->is_fee_submitted && $product->class_type == 'lead')
                    <br>
                    <a href="{{url('/demo-class-form' .'/'.$student->id .'/'.$product->id)}}" class="btn btn-default">Take Demo</a>
                    @endif
                    @if($product->class_type == 'paid' && $product->amount_paid != $product->net_due)
                        <a href="{{url('/student-fee-form' .'/'.$student->id .'/'.$product->id)}}" class="btn btn-primary">Pay</a>
                    @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>





 