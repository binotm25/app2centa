<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h4><b>Personal and Professional Information</b></h4>
	</div>
	<div class="panel-body">
		{!! Form::open(['class'=>'form-horizontal', 'role'=>'form']) !!}

			<div class="form-group {{ $errors->has('participant') ? 'has-error' : '' }}">
                <label for="participant" class="col-sm-6 text-right">Were you a participant in TPO 2015 :</label>
                <div class="col-sm-4">
                	{!! Form::select('participant', ['0'=>'No','1'=>'Registered but did not participated', '2'=>'Participated'], null, ['class' => 'form-control']) !!}
                	{!! $errors->first('participant', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('candi_title') ? 'has-error' : '' }}">
                <label for="candi_title" class="col-sm-6 text-right">Title :</label>
                <span style="position: relative; top: 6px;"><i>(Please choose Ms. in case you use Mrs. as a title)</i></span>
                <div class="col-sm-1">
                	{!! Form::select('parti_title', ['Mr.'=>'Mr.','Ms.'=>'Ms.','Dr.'=>'Dr.','Prof.'=>'Prof.'], null, ['class' => 'custom-form-control']) !!}
                	{!! $errors->first('candi_title', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('candi_fname') ? 'has-error' : '' }}">
                <label for="candi_fname" class="col-sm-6 text-right">Candidate First Name :</label>
                <div class="col-sm-4">
                	{!! Form::text('candi_fname', null, ['class' => 'form-control']) !!}
                	{!! $errors->first('candi_fname', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('candi_lname') ? 'has-error' : '' }}">
                <label for="candi_lname" class="col-sm-6 text-right">Candidate Last Name :</label>
                <div class="col-sm-4">
                	{!! Form::text('candi_lname', null, ['class' => 'form-control']) !!}
                	{!! $errors->first('candi_lname', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

			<div class="form-group">
				<i class="col-md-10 col-md-offset-1 text-center">(Please enter the spellings of your name correctly. Please note that in case you are a winner in TPO 2016, your name will appear in the TPO Certificate in exactly the same way and CENTA will not be able to make changes at that point.)</i>
			</div>

			<div class="form-group {{ $errors->has('candi_dob') ? 'has-error' : '' }}">
                <label for="candi_dob" class="col-sm-6 text-right">Date of Birth :</label>
                <div class="col-sm-4">
                	{!! Form::select('candi_dob_d', $dob_d, date('d'),['class' => 'custom-form-control col-xs-2', 'id'=>'candi_dob_d']) !!}
                	<div class="col-xs-1 date-separator">//</div>
                	{!! Form::select('candi_dob_m', $month, date('m'),['class' => 'custom-form-control col-xs-3', 'id'=>'candi_dob_m']) !!}
                	<div class="col-xs-1 date-separator">//</div>
                	{!! Form::select('candi_dob_y', $year, (date('Y') - 18),['class' => 'custom-form-control col-xs-3', 'id'=>'candi_dob_y']) !!}

                	{!! $errors->first('candi_dob_d', '<span class="help-block">:message</span>') !!}
                	{!! $errors->first('candi_dob_m', '<span class="help-block">:message</span>') !!}
                	{!! $errors->first('candi_dob_y', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

			<div class="form-group {{ $errors->has('candi_hel') ? 'has-error' : '' }}">
                <label for="candi_hel" class="col-sm-6 text-right">Highest level of Education :</label>
                <div class="col-sm-4">
                	{!! Form::select('candi_hel', ['1'=>'Graduation', '2'=>'Post Graduation', '3'=>'Doctoral/ Post Doctoral','4'=>'Diploma'], null, ['class' => 'form-control', 'id'=>'candi_hel']) !!}
                	{!! $errors->first('candi_hel', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('d_d_e') ? 'has-error' : '' }}">
                <label for="d_d_e" class="col-sm-6 text-right">If you have a degree or diploma in Education then tick all that apply :</label>
                <div class="col-sm-4">
                    @foreach($dde as $key=>$value)
                    	<div class="row">
                    		<label class="radio-inline">
                    			<input type="checkbox" {{ $key == 'diploma' ? 'checked' : ''}} value="{{ $key }}" name="d_d_e[]" class="d_d_e" id="dde_{{$key}}">
                    			{{ $value }}
                        	</label>
                    	</div>
                    @endforeach
                    {!! Form::text('d_d_e_others', null, ['class'=>'form-control hidden','id'=>'others-dde']) !!}
                	{!! $errors->first('d_d_e', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group text-center">
            	<i>(Please note: Except for those with Diploma as the highest level of education, having a degree or diploma in Education is not necessary, for participating in the TPO)</i>
            </div>
           
			<div class="form-group {{ $errors->has('candi_state') ? 'has-error' : '' }}">
                <label for="candi_state" class="col-sm-6 text-right">State/Union Territory of current residence :</label>
                <div class="col-sm-4">
                	{!! Form::select('candi_state', $stateNames, null, ['class' => 'custom-form-control col-xs-7', 'id'=>'candi_state']) !!}

                	<div class="checkbox">
                		<label class="not-from-india">
                			<input type="checkbox" name="not_from_india" id="not_from_india">
                			Not From India
                		</label>
                	</div>
                	{!! $errors->first('candi_state', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
			<div class="form-group {{ $errors->has('candi_city') ? 'has-error' : '' }}">
                <label for="candi_city" class="col-sm-6 text-right">City/Town/Village :</label>
                <div class="col-sm-4">
                    {!! Form::select('candi_city', $stateNames, null, ['class' => 'form-control', 'id'=>'candi_city']) !!}
                    {!! $errors->first('candi_city', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('heard_tpo') ? 'has-error' : '' }}">
                <label for="heard_tpo" class="col-sm-6 text-right">Where did you hear about the TPO :</label>
                <div class="col-sm-4">
                	{!! Form::select('heard_tpo', $tpo_heard, null, ['class' => 'form-control', 'id'=>'heard_tpo']) !!}

                    @include('layouts.forms._tpoHeard')
                	{!! $errors->first('heard_tpo', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
			
			<div class="form-group {{ $errors->has('r_code') ? 'has-error' : '' }}">
                <label for="r_code" class="col-sm-6 text-right">Reference code if any :</label>
                <div class="col-sm-4">
                	{!! Form::text('r_code', null, ['class' => 'form-control', 'id'=>'r_code']) !!}
                	{!! $errors->first('r_code', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group text-center">
            	<i>(Please note that note all candidates would be having a reference code. In case you do, you would have already been informed via a text or email or your organization)</i>
            </div>

            <div class="form-group {{ $errors->has('noa') ? 'has-error' : '' }}">
                <label for="noa" class="col-sm-6 text-right">Nature of association with teaching :</label>
                <div class="col-sm-4">
                        @foreach($noa as $id=>$value)
                            @if($id==1)
                            &nbsp;&nbsp;&nbsp;
                            @endif
                            <label class="radio-inline">
                                <input type="radio" {{ $id==1 ? 'checked' : '' }} value="{{ $id }}" name="noa" id="noa">
                                {{ $value }}
                            </label>
                        @endforeach

                	{!! $errors->first('noa', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

			<div class="form-group">
                {!! Form::button('Validate', ['class'=>'col-sm-2 btn btn-primary reg-validate', 'id'=>'validate1']) !!}
				{!! Form::submit('Next Step', ['class'=>'col-sm-2 btn btn-success reg-submit', 'id'=>'submit1']) !!}
			</div>

		{!! Form::close() !!}
	</div>
</div>