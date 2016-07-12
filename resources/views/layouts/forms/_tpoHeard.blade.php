@foreach($tpo_heard2 as $tpo1 => $value)
	@foreach($value as $key => $tpo)
		<div class="row tpo-heard-mayam tpo-{{ $tpo1 }}">
		     <label class="radio-inline">
		        <input type="radio" value="{{ $key }}" name="tpo_heard_2">
		        @if(is_array($tpo))
		        	{{ $tpo[0] }} <input type="text" id="heard_from_{{$tpo1.'_'.$key}}" name="heard_from_{{$tpo1.'_'.$key}}" class="col-sm-7 form-control heard-from-others">
		        @else
		        	{{ $tpo }}
		        @endif
		    </label>
		</div>
	@endforeach
@endforeach