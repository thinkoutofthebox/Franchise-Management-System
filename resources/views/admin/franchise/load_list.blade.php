@if(count($franchises->items()) > 0)
<table class="table">
  <thead>
    <tr>
		<th>Status</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>View</th>
    </tr>
  </thead>
  <tbody>
  @foreach($franchises->items() as $franchise) 
    <tr>
		<td>{{$franchise->is_approved ? 'Approved' : 'Pending for Approval'}}</td>
		<td>{{$franchise->name}}</td>
		<td>{{$franchise->email}}</td>
		<td>{{$franchise->phone}}</td>
		<td><a href="{{url('/franchise-details'.'/'.$franchise->id)}}">View</a></td>
    </tr>
  @endforeach
  </tbody>
</table>
@if(count($franchises->items()) > 20)
	<ul class="pagination pull-right">
		@if($franchises->currentPage() == 1 )
			<li class="paginate_button previous disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous">
				<a >Previous</a>
			</li>
		@else
			<li class="paginate_button previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous" >
				<a href="#" onclick="ajaxLoad('{{ $franchises->previousPageUrl() }}')">Previous</a>
			</li>
		@endif
		@for($i=1;$i<=$franchises->lastPage();$i++)
			@if($franchises->currentPage() == $i)
				<li class="paginate_button active" aria-controls="dynamic-table" tabindex="0" >
					<a >{{ $i }}</a>
				</li>
			@else
				<li class="paginate_button " aria-controls="dynamic-table" tabindex="0" >
					<!--<a href="{{ url('/view-franchises?page='.$i) }}">{{ $i }}</a>-->
					<a href="#" onclick="ajaxLoad('{{ url(Request::getPathInfo().'?page='.$i) }}')">{{ $i }}</a>
				</li>
			
			@endif
					
		@endfor
		@if($franchises->currentPage() == $franchises->lastPage())
			<li class="paginate_button next disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next">
				<a >Next</a>
			</li>
		@else
			<li class="paginate_button next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next" >
				<a href="#" onclick="ajaxLoad('{{ $franchises->nextPageUrl() }}')">Next</a>
			</li>
		@endif
		<li class="paginate_button" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next">
			<a>Total Records : {{ $franchises->total() }}</a>
		</li>
	</ul>
@endif
@else
	<div> No Data Availables</div>
@endif