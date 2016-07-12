<div class="panel panel-info">
	<div class="panel-heading text-center">
		Last Step
	</div>
	<div class="panel-body">
		{!! Form::open(['class'=>'form-horizontal','role'=>'form']) !!}
			<input type="hidden" name="part_type" id="part2_type" value="{{ $register->category }}">
			<input type="hidden" name="reg_id" id="part2_type" value="{{ $register->id }}">

			<div class="form-group {{ $errors->has('reg2_course') ? 'has-error' : '' }}">
				<label for="location_city" class="col-sm-6 text-right">Which course are you studying :</label>
				<div class="col-sm-4">
                	{!! Form::select('reg2_course', ['diploma'=>'Diploma in Education', 2=>'B.Ed.',3=>'M.Ed.',4=>'Trained Graduate Teacher (TGT)', 5=>'Cambridge Diploma for Teachers and Trainers (CIDTT)', 6=>'Others, please specify'], null, ['class' => 'form-control','id'=>'reg2_course']) !!}
                	{!! Form::text('reg2_other_course', null, ['class'=>'form-control', 'id'=>'other_course']) !!}
                	{!! $errors->first('reg2_course', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('location_state') ? 'has-error' : '' }}">
				<label for="reg2_location_state" class="col-sm-6 text-right">State :</label>
				<div class="col-sm-4">
                	{!! Form::select('location_state', $states, null, ['class' => 'form-control','id'=>'reg_location_state']) !!}
                	{!! $errors->first('location_state', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('location_city') ? 'has-error' : '' }}">
				<label for="reg2_location_city" class="col-sm-6 text-right">City :</label>
				<div class="col-sm-4">
                	{!! Form::text('reg2_location_city', null, ['class' => 'form-control','id'=>'reg_location_city']) !!}
                	{!! $errors->first('reg2_location_city', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('institute_id') ? 'has-error' : '' }}">
				<label for="institute_id" class="col-sm-6 text-right">Institute Name :</label>
				<div class="col-sm-4">
                	{!! Form::select('institute_id', $institutes, null, ['class' => 'form-control','id'=>'reg_institute_name']) !!}
                	{!! $errors->first('institute_id', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('course_duration') ? 'has-error' : '' }}">
				<label for="reg2_course_duration" class="col-sm-6 text-right">Duration of the course :</label>
				<div class="col-sm-4">
                	{!! Form::select('reg2_course_duration', [1=>'1 Year or Below', 2=>'Between 1 and 2 Years', 3=>'Greater than 2 years'], null, ['class' => 'form-control','id'=>'course_duration']) !!}
                	{!! $errors->first('reg2_course_duration', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('course_fee') ? 'has-error' : '' }}">
				<label for="reg2_course_fee" class="col-sm-6 text-right">Approximate fee level for the full course :</label>
				<div class="col-sm-4">
                	{!! Form::select('reg2_course_fee', [1=>'Less than Rs. 10,000', 2=>'Rs. 10,000 - Rs. 30,000', 3=>'Rs. 30,000 - Rs. 70,000',4=>'Rs. 70,000 - Rs. 1,00,000',5=>'Greater than Rs. 1,00,000'], null, ['class' => 'form-control','id'=>'course_fee']) !!}
                	{!! $errors->first('reg2_course_fee', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('other_institute') ? 'has-error' : '' }}">
				<label for="other_institute" class="col-sm-6 text-right">Other Institute :</label>
				<div class="col-sm-4">
					<div class="checkbox other-school">
						<label class="radio-inline">
		        			<input type="checkbox" id="other_institute" value="off" name="other_institute" class="other_institute">
		        			My Institute is not listed above
		        		</label>
					</div>
					<input type="text" class="form-control other-school-section" placeholder="Your Institute Name" name="other_institute_name" id="other_institute_name"/>
				</div>
			</div>

			<div class="form-group {{ $errors->has('new_institute_address') ? 'has-error' : '' }} other-school-section">
				<label for="new_institute_address" class="col-sm-6 text-right">Location within the City :</label>
				<div class="col-sm-4">
                	{!! Form::text('new_institute_address', null, ['class' => 'form-control', 'placeholder'=>'Address']) !!}
                	{!! $errors->first('new_institute_address', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group">
				{!! Form::submit('Submit', ['class'=>'col-sm-offset-5 col-sm-2 btn btn-success', 'id'=>'submit2']) !!}
			</div>	

		{!! Form::close() !!}
	</div>
</div>