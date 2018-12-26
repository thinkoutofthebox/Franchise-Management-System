@if(count($students->items()) > 0)
<table class="table">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>View</th>
    </tr>
  @foreach($students->items() as $student) 
    <tr>
      <td>{{$student->name}}</td>
      <td>{{$student->email}}</td>
      <td>{{$student->phone}}</td>
      <td><a href="{{url('/student-details'.'/'.$student->id)}}">View</a></td>
    </tr>
  @endforeach
</table>
@if(count($students->items()) > 20)
	<nav aria-label="Page navigation">
		<ul class="pagination">
			@if($students->currentPage() == 1 )
				<li class="page-item disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous">
					<a class="page-link">Previous</a>
				</li>
			@else
				<li class="page-item previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous" >
					<a href="#" class="page-link" onclick="ajaxLoad('{{ $students->previousPageUrl() }}')">Previous</a>
				</li>
			@endif
			@for($i=1;$i<=$students->lastPage();$i++)
				@if($students->currentPage() == $i)
					<li class="page-item active" aria-controls="dynamic-table" tabindex="0" >
						<a class="page-link">{{ $i }}</a>
					</li>
				@else
					<li class="page-item" aria-controls="dynamic-table" tabindex="0" >
						<!--<a href="{{ url('/view-students?page='.$i) }}">{{ $i }}</a>-->
						<a href="#" class="page-link" onclick="ajaxLoad('{{ url(Request::getPathInfo().'?page='.$i) }}')">{{ $i }}</a>
					</li>
			
				@endif	
					
				@endfor
				@if($students->currentPage() == $students->lastPage())
					<li class="page-item next disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next">
						<a class="page-link">Next</a>
					</li>
				@else
					<li class="page-item next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next" >
						<a href="#" class="page-link" onclick="ajaxLoad('{{ $students->nextPageUrl() }}')">Next</a>
					</li>
				@endif	
		</ul>
	</nav>
@endif
@else
	<div class="no-found"> 
		<div class="icon-wrapper">
			<img src="{{asset('images/no-user-icon.svg')}}" alt="No Student Found" />
		</div>
		<h4>No Students at This Time</h4>
		<p>Students will appear here after franchise owner manually register students from student registration page.</p>
	</div>
@endif
