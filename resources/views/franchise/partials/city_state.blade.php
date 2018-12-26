<option value="">--Please Select City--</option>
@foreach($states_cities as $state_city)
<option value="{{$state_city->city_name}}">{{$state_city->city_name}}</option>
@endforeach