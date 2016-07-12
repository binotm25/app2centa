@extends('layouts.app')

@section('customCss')
    <link rel="stylesheet" href="{{ URL::asset('css/phone/intlTelInput.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('password-confirm', 'Confirm Password',['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['class'=>'form-control', 'id'=>'password-confirm']) !!}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{!! $errors->has('mobile_no') ? 'has-error' : '' !!}">
                            {!! Form::label('mobile_no', 'Mobile No.', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <input type="tel" name="mobile_no" class="form-control col-sm-6" id="mobile_no">
                                <input type="hidden" id="extension" name="extension" />
                                {!! $errors->first('mobile_no', '<span class="help-block">:message</span>') !!}
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
    <script src="{{ URL::asset('js/phone/intlTelInput.min.js') }}"></script>
    <script>
        var pathArray = window.location.pathname.split( '/' ); var urlPath = location.origin+'/'+pathArray[1]+'/'+pathArray[2];
        $("#mobile_no").intlTelInput({
            allowDropdown: true,
            autoHideDialCode: false,
            autoPlaceholder: true,
            dropdownContainer: "body",
            //excludeCountries: ["us"],
            geoIpLookup: function(callback) {
                $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            initialCountry: "auto",
            nationalMode: false,
            numberType: "MOBILE",
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            preferredCountries: ['in', 'jp'],
            separateDialCode: true,
            utilsScript: urlPath+"/js/phone/utils.js"
        });

        // listen to the telephone input for changes
        $("#mobile_no").on("countrychange", function(e, countryData) {
            $("#extension").val(countryData.dialCode);
            console.log(countryData.dialCode);
        });
    </script>
@endsection