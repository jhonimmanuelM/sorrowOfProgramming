{!! Form::open(array('route' => 'nhr.interview.edit','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{$interview->id}}">
<input type="hidden" name="candidate_id" value="{{$interview->candidate_id}}">
<input type="hidden" name="NHR_id" value="{{$interview->NHR_id}}">
<div class="collapse" id="editInterview{{$interview->id}}">
  <div class="form-group">
    <label>Interviwer</label>
    <select class="form-control" name="employee_id" required>
      <option value=""></option>
      @foreach($users as $user)
          @php
            $selected = '';
            if($user->id == $interview->employee_id){
              $selected = 'selected';
            }
          @endphp
          <option value="{{$user->id}}" {{$selected}}>{{$user->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Interview Type</label>
    <input type="text" class="form-control" id="interview_type" name="interview_type" required value="{{$interview->interview_type}}">
  </div>
  <div class="form-group">
    <label>Schedule At</label>
    <input type="datetime-local" class="form-control" name="scheduled_at" id="scheduled_at">
  </div>
  <div class="form-group">
    <label class="form-label">Proceed to Next Round</label>
    <div class="selectgroup selectgroup-pills">
      <label class="selectgroup-item">
        <input type="radio" name="status" value="1" class="selectgroup-input">
        <span class="selectgroup-button selectgroup-button-icon"><i class="material-icons">thumb_up</i></span>
      </label>
      <label class="selectgroup-item">
        <input type="radio" name="status" value="2" class="selectgroup-input">
        <span class="selectgroup-button selectgroup-button-icon"><i class="material-icons">thumb_down</i></span>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label>Feedback</label>
    <textarea class="form-control" id="feedback" name="feedback" required>{{$interview->feedback}}</textarea>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-success">Update</button>
  </div>
</div>
{!! Form::close() !!}