@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-sm-6 col-sm-offset-3">
			{!! Form::open(['class'=>'form-horizontal','role'=>'form']) !!}
				<input type="hidden" name="registrationId" value="{{ $registrationId }}">
				<div class="form-group">
					<label for="pay">Done Payment</label>
					{!! Form::select('payment', ['0'=>'Cancel', '1'=>'Pay'], null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Submit', ['class'=>'col-sm-offset-5 col-sm-2 btn btn-success', 'id'=>'submitPayment']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection