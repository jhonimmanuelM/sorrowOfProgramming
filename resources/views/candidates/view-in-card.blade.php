<div class="card card-info">
  <div class="card-header">
    <h4>Candidate</h4>
  </div>
  <div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <b>First Name :</b> 
            {{ $candidate->first_name }}
        </li>
        <li class="list-group-item">
            <b>Last Name :</b> 
            {{ $candidate->last_name }}
        </li>
        <li class="list-group-item">
            <b>DOB :</b> 
            {{Carbon\Carbon::parse($candidate->date_of_birth)->toDateString()}}
        </li>
        <li class="list-group-item">
            <b>Email :</b> 
            {{$candidate->email}}
        </li>
        <li class="list-group-item">
            <b>Email :</b>
            @foreach($position_collection as $position)
                @if($position->id == $candidate_positions->id) 
                    {{$position->position}}
                @endif
            @endforeach
        </li>
        <li class="list-group-item">
            <b>Skills :</b>
            <div class="selectgroup selectgroup-pills">
                @foreach($skills_collection as $skill)
                    @php
                        $checked = '';
                        if(in_array($skill->id,$candidate_skills)){
                            $checked = 'checked';
                        }
                    @endphp
                    <label class="selectgroup-item">
                        <input type="checkbox" value="{{$skill->id}}" class="selectgroup-input" name="skills[]" {{$checked}}>
                        <span class="selectgroup-button">{{$skill->skill}}</span>
                    </label>
                @endforeach
            </div>
        </li>
        <li class="list-group-item">
            <b>CTC :</b> 
            {{$candidate->ctc}}
        </li>
        <li class="list-group-item">
            <b>ECTC :</b> 
            {{$candidate->ectc}}
        </li>
        <li class="list-group-item">
            <b>Notice Periods (In Days) :</b> 
            {{$candidate->notice_period}}
        </li>
        <li class="list-group-item">
            <b>Experience (In Months) :</b> 
            {{$candidate->year_of_experience}}
        </li>
        <li class="list-group-item">
            <b>Current Company :</b> 
            {{$candidate->current_company_name}}
        </li>
        <li class="list-group-item">
            <b>Previous Company :</b> 
            {{$candidate->previous_company_name}}
        </li>
        <li class="list-group-item">
            <b>Resume :</b> 
            <a href="{{url('/uploads')}}/{{$candidate->resume}}">Download</a>
        </li>
    </ul>
  </div>
</div>