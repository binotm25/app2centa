@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<section class="personal">
				@include('layouts.forms._regFormPersonal')
			</section>
		</div>
	</div>
@endsection