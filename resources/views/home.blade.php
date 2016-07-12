@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Proceed to Registration for TPO {{ date('Y') }}</div>

                <div class="panel-body">
                    <h4>Click on either:</h4>
                    {!! Form::open(['role'=>'form']) !!}
                        <div class="form-group user-type">
                            <label class="radio-inline">
                                {!! Form::radio('user_type', '0', true); !!}
                                I am an individual who wants to register for CENTA TPO {{ date('Y') }}.
                            </label> <br/>
                            <label class="radio-inline">
                                {!! Form::radio('user_type', '1'); !!}
                                I represent an institution which would like to register 10 or more candidates for TPO {{ date('Y') }}.
                            </label>
                        </div>
                        <div class="form-group text-justify">
                            <p><i>(Please note: Institutional registration is open only in cases where there are 10 or more candidates registering from the same school or teacher training college or other organization. There is no change in fees per head. Institutional registration only allows you to enter all the names and other information in one shot. Other individuals from the same institution can also do individual registration in case they miss the group registration.)</i></p>
                        </div>  
                        <hr />
                        <div class="form-group col-md-2 pull-right">
                            {!! Form::submit('Proceed', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
