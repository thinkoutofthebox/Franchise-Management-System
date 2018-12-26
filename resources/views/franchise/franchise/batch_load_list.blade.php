@if(count($batches->items()) > 0)
<table class="table">
  <tbody>
    <tr>
      <th>Batch Name</th>
      <th>Batch Start Date</th>
      <th>Batch Timings</th>
      <th>Status</th>
    </tr>
  @foreach($batches->items() as $batch) 
    <tr>
      <td>{{$batch->batch_name}}</td>
      <td>{{date('d M Y', strtotime($batch->batch_start))}}</td>
      <td>{{$batch->batch_timing_start .' - '.$batch->batch_timing_end}}</td>
      <td>{{$batch->status ? 'Approved' : 'Not Approved'}}</td>
    </tr>
  @endforeach
  </tbody>
</table>

@if(count($batches->items()) > 20)
	<nav aria-label="Page navigation">
		<ul class="pagination">
			@if($batches->currentPage() == 1 )
				<li class="page-item disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous">
					<a class="page-link">Previous</a>
				</li>
			@else
				<li class="page-item previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous" >
					<a href="#" class="page-link" onclick="ajaxLoad('{{ $batches->previousPageUrl() }}')">Previous</a>
				</li>
			@endif
			@for($i=1;$i<=$batches->lastPage();$i++)
				@if($batches->currentPage() == $i)
					<li class="page-item active" aria-controls="dynamic-table" tabindex="0" >
						<a class="page-link">{{ $i }}</a>
					</li>
				@else
					<li class="page-item" aria-controls="dynamic-table" tabindex="0" >
						<!--<a href="{{ url('/view-batches?page='.$i) }}">{{ $i }}</a>-->
						<a href="#" class="page-link" onclick="ajaxLoad('{{ url(Request::getPathInfo().'?page='.$i) }}')">{{ $i }}</a>
					</li>
			
				@endif	
					
				@endfor
				@if($batches->currentPage() == $batches->lastPage())
					<li class="page-item next disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next">
						<a class="page-link">Next</a>
					</li>
				@else
					<li class="page-item next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next" >
						<a href="#" class="page-link" onclick="ajaxLoad('{{ $batches->nextPageUrl() }}')">Next</a>
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
		<h4>No Records Found</h4>
	</div>
@endif