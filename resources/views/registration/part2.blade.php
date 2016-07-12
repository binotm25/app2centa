@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@if($type == 1)
				@include('layouts.forms._regPart2Type1')
			@elseif($type == 2)
				@include('layouts.forms._regPart2Type2')
			@elseif($type == 3)
				@include('layouts.forms._regPart2Type3')
			@elseif($type == 4)
				@include('layouts.forms._regPart2Type4')
			@endif
		</div>
	</div>
@endsection