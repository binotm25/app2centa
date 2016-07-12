<div class="panel panel-info">
	<div class="panel-heading text-center">
		Last Step
	</div>
	<div class="panel-body">
		{!! Form::open(['class'=>'form-horizontal','role'=>'form']) !!}
			<input type="hidden" name="part_type" id="part2_type" value="{{ $register->category }}">
			<input type="hidden" name="reg_id" id="part2_type" value="{{ $register->id }}">

			<div class="form-group {{ $errors->has('location_state') ? 'has-error' : '' }}">
				<label for="location_state" class="col-sm-6 text-right">State :</label>
				<div class="col-sm-4">
                	{!! Form::select('location_state', $states, null, ['class' => 'form-control','id'=>'reg_location_state']) !!}
                	{!! $errors->first('location_state', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('location_city') ? 'has-error' : '' }}">
				<label for="location_city" class="col-sm-6 text-right">City :</label>
				<div class="col-sm-4">
                	{!! Form::text('location_city', null, ['class' => 'form-control','id'=>'reg_location_city']) !!}
                	{!! $errors->first('location_city', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('school_name') ? 'has-error' : '' }}">
                <label for="school_name" class="col-sm-6 text-right">Name of the School :</label>
                <div class="col-sm-4">
                	{!! Form::select('school_name', $schools, null, ['class' => 'form-control', 'id'=>'reg_school_name']) !!}
                	{!! $errors->first('school_name', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

			<div class="form-group {{ $errors->has('school_type') ? 'has-error' : '' }}">
				<label for="school_type" class="col-sm-6 text-right">School Type :</label>
				<div class="col-sm-4">
                	{!! Form::select('school_type',['private'=>'Private', 'govt'=>'Government','govt_aided'=>'Government Aided'], null, ['class' => 'form-control', 'id'=>'school_type']) !!}
                	{!! $errors->first('school_type', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('school_board') ? 'has-error' : '' }}">
				<label for="school_board" class="col-sm-6 text-right">School Board :</label>
				<div class="col-sm-4">
                	{!! Form::select('school_board', ['cbse'=>'CBSE','icse/isc'=>'ICSE/ISC','state'=>'State Board','ib'=>'IB','icbse'=>'iCBSE','matriculation'=>'Matriculation'], null, ['class' => 'form-control', 'id'=>'school_board']) !!}
                	{!! $errors->first('school_board', '<span class="help-block">:message</span>') !!}
                </div>
			</div>

			<div class="form-group {{ $errors->has('avg_fee') ? 'has-error' : '' }}">
				<label for="avg_fee" class="col-sm-6 text-right">Average fee level for students in the school :</label>
				<div class="col-sm-4">
                	{!! Form::select('avg_fee', ['1'=>'Less than Rs. 1000 a month','2'=>'Rs. 1000- Rs. 2000 a month','3'=>'Rs. 2000 - Rs. 5000 a month','4'=>'Rs. 5000- Rs. 10000 a month','5'=>'Greater than Rs. 10000 a month'], null, ['class' => 'form-control','id'=>'reg_school_fee']) !!}
                	{!! $errors->first('avg_fee', '<span class="help-block">:message</span>') !!}
                </div>
			</div>
			<div class="form-group text-center">
				<i>(Please note: The purpose of this information is only to understand what socio-economic segment you are most likely serving.)</i>
			</div>

			<div class="form-group {{ $errors->has('other_school') ? 'has-error' : '' }}">
				<label for="other_school" class="col-sm-6 text-right">Other School :</label>
				<div class="col-sm-4">
					<div class="checkbox other-school">
						<label class="radio-inline">
		        			<input type="checkbox" id="other_school" value="off" name="other_school" class="other_school">
		        			My School is not listed above
		        		</label>
					</div>
					<input type="text" class="form-control other-school-section" placeholder="Your School Name" name="other_school_name" id="other_school_name"/>
				</div>
			</div>
			<section class="other-school-section">
				<div class="form-group {{ $errors->has('other_school_address') ? 'has-error' : '' }}">
					<label for="other_school_address" class="col-sm-6 text-right">Location within the State :</label>
					<div class="col-sm-4">
						{!! Form::text('other_school_address', null, ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group {{ $errors->has('other_school_city') ? 'has-error' : '' }}">
					<label for="other_school_city" class="col-sm-6 text-right">City/Town/Village :</label>
					<div class="col-sm-4">
						{!! Form::text('other_school_city', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group text-center">
					<i>(Please enter the full name of your school with correct spellings. Please note that in case you are a winner in TPO 2016, your school name will appear in the TPO Certificate in exactly the same way and CENTA will not be able to make changes at that point.)</i>
				</div>

				<div class="form-group {{ $errors->has('other_school_type') ? 'has-error' : '' }}">
					<label for="other_school_type" class="col-sm-6 text-right">School Type :</label>
					<div class="col-sm-4">
	                	{!! Form::select('other_school_type',['private'=>'Private', 'govt'=>'Government','govt_aided'=>'Government Aided'], null, ['class' => 'form-control']) !!}
	                	{!! $errors->first('other_school_type', '<span class="help-block">:message</span>') !!}
	                </div>
				</div>

				<div class="form-group {{ $errors->has('other_school_board') ? 'has-error' : '' }}">
					<label for="other_school_board" class="col-sm-6 text-right">School Board :</label>
					<div class="col-sm-4">
	                	{!! Form::select('other_school_board', ['cbse'=>'CBSE','icse/isc'=>'ICSE/ISC','state'=>'State Board','ib'=>'IB','icbse'=>'iCBSE','matriculation'=>'Matriculation'], null, ['class' => 'form-control']) !!}
	                	{!! $errors->first('other_school_board', '<span class="help-block">:message</span>') !!}
	                </div>
				</div>

				<div class="form-group {{ $errors->has('other_avg_fee') ? 'has-error' : '' }}">
					<label for="other_avg_fee" class="col-sm-6 text-right">Average fee level for students in the school :</label>
					<div class="col-sm-4">
	                	{!! Form::select('other_avg_fee', ['1'=>'Less than Rs. 1000 a month','2'=>'Rs. 1000- Rs. 2000 a month','3'=>'Rs. 2000 - Rs. 5000 a month','4'=>'Rs. 5000- Rs. 10000 a month','5'=>'Greater than Rs. 10000 a month'], null, ['class' => 'form-control']) !!}
	                	{!! $errors->first('other_avg_fee', '<span class="help-block">:message</span>') !!}
	                </div>
				</div>
				<div class="form-group text-center">
					<i>(Please note: The purpose of this information is only to understand what socio-economic segment you are most likely serving.)</i>
				</div>
			</section>

			<div class="form-group">
				{!! Form::submit('Submit', ['class'=>'col-sm-offset-5 col-sm-2 btn btn-success', 'id'=>'submit2']) !!}
			</div>	

		{!! Form::close() !!}
	</div>
</div>