{!! Form::open(array('route' => 'nhr.interview.schedule','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="candidate_id" value="{{$candidate->id}}">
<input type="hidden" name="NHR_id" value="{{$new_hire_request->id}}">
<div class="collapse" id="scheduleInterviewCollapse" style="">
  <div class="card card-primary">
      <div class="card-header">
        <h4>Schedule Interview</h4>
        <div class="card-header-action">
          <button type="submit" class="btn btn-success">Schedule</button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label>Interviwer</label>
          <select class="form-control" name="employee_id" required>
            <option value=""></option>
            @foreach($interviewers as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Interview Type</label>
          <input type="text" class="form-control" id="interview_type" name="interview_type" required>
        </div>
        <div class="form-group">
          <label>Schedule At</label>
          <input type="datetime-local" class="form-control" required name="scheduled_at" id="scheduled_at">
        </div>
      </div>
  </div>
</div>
{!! Form::close() !!}