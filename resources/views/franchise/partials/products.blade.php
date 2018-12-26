<option value="">--Please Select--</option>
@foreach($products as $product)
<option value="{{$product->pid}}">{{$product->product_name}}</option>
@endforeach