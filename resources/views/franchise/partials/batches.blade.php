<option value="">--Please Select--</option>
@foreach($batches as $batch)
<option value="{{$batch->id}}">{{$batch->batch_name}} ({{'Batch Timing:'.$batch->batch_timing_start .'-'.$batch->batch_timing_end }})</option>
@endforeach