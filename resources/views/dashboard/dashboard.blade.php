@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">Registered Users</div>
					<div class="panel-body">
						<div class="alert alert-success text-center" role="alert">
							Click <a href="{{ route('register_get1') }}">Here to Register Yourself or Other Candidates</a>
						</div>
						
						@if($user->registration->count() != 0)
							<div class="panel-body">
								<h5 class="text-center">You have {{ $user->registration->count() }} Registered {{ str_plural('User', $user->registration->count()) }}</h5>
								<div class="table-responsive">
									<table class="fit-table table table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-center">Sl. No.</th>
												<th class="text-center">Candidate's Name</th>
												<th class="text-center">Date Of Birth</th>
												<th class="text-center">Highest Edu. Level</th>
												<th class="text-center">Degree</th>
												{{-- <th>Deg. Others</th> --}}
												<th class="text-center">Category</th>
												<th class="text-center">Nature Of Assoc</th>
												<th class="text-center">Applied On</th>
												<th class="text-center">Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach($user->registration as $key => $reg)
												<tr class="text-capitalize text-center">
													<td>{{ $key + 1 }}</td>
													<td>{{ $reg->title }} {{ $reg->f_name }} {{ $reg->l_name }}</td>
													<td>{{ $reg->dob->format('d-m-Y') }}</td>
													<td>{{ $reg->hel }}</td>
													<td>{{ $reg->degree }}</td>
													{{-- <td>{{ $reg->degree_others ?: 'N.A' }}</td> --}}
													<td>{{ $reg->category }}</td>
													<td>{{ $noa[$reg->noa] }}</td>
													<td>{{ $reg->created_at->format('d-m-Y') }}</td>
													<td>{{ $reg->status == 1 ? 'Completed' : 'Pending' }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						@else
							<div class="alert alert-danger text-center" role="alert">You haven't registered any candidates so far. Click the link above.</div>
						@endif

					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-info">
					<div class="panel-heading text-center">Unfinished Sessions</div>
					<div class="panel-body">
						@foreach($user->registration->where('status', 0) as $session)
							<div class="alert alert-success" role="alert">
								For {{ $session->title }} {{ $session->f_name }} {{ $session->l_name }}
								<a class="btn btn-warning pull-right" href="{{ $session->session_id == 2 ? urldecode(route('paymentGet', ['registerId'=>$session->id])) : urldecode(route('register_get'.($session->session_id + 1), ['registerId'=>$session->id])) }}">
									Part - {{ $session->session_id == 2 ? 'Payment' : $session->session_id + 1 }}
								</a>
							</div>
						@endforeach
							
						@if($user->registration->count() < 1)
							<div class="alert alert-danger text-center" role="alert">Sorry! You don't have any sessions.</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		
	</div>
@endsection