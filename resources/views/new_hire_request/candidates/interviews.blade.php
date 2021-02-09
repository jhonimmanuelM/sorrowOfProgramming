<table class="table interview-table">
	<thead>
		<tr>
			<th>Interview Details</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@if(count($interviews) > 0)
			@foreach($interviews as $interview)
				<tr>
					<td>
                        <div class="interview-details">
						<b>Interviewer :</b>
						@php
							$temp = $users->where('id',$interview->employee_id)->first();
							if($temp){
								$temp = $temp->name;
							}else{
								$temp = 'NA';
							}
						@endphp
						{{ $temp}}
                        </div>
                        <div class="interview-details">
						<b>Interview Type:</b>
						{{$interview->interview_type}}
                        </div>
                        <div class="interview-details">
						<b>Schedule At :</b>
						{{Carbon\Carbon::parse($interview->scheduled_at)->toDayDateTimeString()}}
                        </div>
                        <div class="interview-details">
						@if($interview->status == 0)
							<b>Status:</b>
							<span class="text-warning">Schedulded</span>
						@endif
                        </div>
                        <div class="interview-details">
						@if($interview->status == 1)
							<b>Status:</b>
							<span class="text-success">Forwarded to Next Round</span>
						@endif
                        </div>
                        <div class="interview-details">
						@if($interview->status == 2)
							<b>Interview Type:</b>
							<span class="text-danger">Candidate Eliminated</span>
						@endif
                        </div>
					</td>
					<td class="table-custom-btn">
						@if($interview->status)
							<a data-toggle="collapse" data-target="#viewInterviewFeedback{{$interview->id}}" aria-expanded="false" aria-controls="viewInterviewFeedback{{$interview->id}}" class="btn btn-outline-secondary rounded-btn"><i class="fas fa-eye"></i></a>
						@else
							@if(Auth::user()->hasRole(['Recruiter','Interviewer']))
								<button data-toggle="collapse" data-target="#editInterview{{$interview->id}}" aria-expanded="false" aria-controls="editInterview{{$interview->id}}" class="btn btn-outline-warning rounded-btn"><i class="fas fa-pencil-alt"></i></button>
							@endif
							@if(Auth::user()->hasRole('Recruiter'))
								<a href="{{ route('nhr.interview.delete',$interview->id) }}" class="btn btn-outline-danger rounded-btn"><i class="fas fa-trash-alt"></i></a>
							@endif
						@endif
					</td>
				</tr>
				<tr>
					<td colspan="2">
						@include('new_hire_request.candidates.edit-interviews')
						@include('new_hire_request.candidates.interview-feedback')
					</td>
				</tr>
			@endforeach
		@else
		<tr>
			<td colspan="2" align="center">No Interview Schedulded Yet</td>
		</tr>
		@endif
	</tbody>
</table>
