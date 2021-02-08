@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        @include('general.alerts')
        <div class="card">
            {!! Form::open(array('route' => 'nhr.update','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
            <div class="card-header">
                <h4 class="card-title">NHR - Create</h4>
                <div class="card-btn">
                    <button type="submit" class="btn btn-success">Update NHR</button>
                    <a href="{{ route('nhr.index') }}"><button type="button" class="btn btn-outline-secondary">Back</button></a>
                </div>
            </div>
            <div class="card-body">
               <div class="col-xl-8">
                   <input type="hidden" name="id" value="{{$new_hire_request->id}}">
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label class="control-label" for="candidate_role_id">Role</label>
                               <select class="custom-select"  id="candidate_role_id" name="candidate_role_id" required>
                                   <option value="">Select Positions</option>
                                   @foreach($positions as $position)
                                       @php
                                           $selected = '';
                                           if($position->id == $new_hire_request->candidate_role_id){
                                               $selected = 'selected';
                                           }
                                       @endphp
                                       <option value="{{$position->id}}" {{$selected}}>{{$position->position}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label class="control-label" for="team_id">Teams</label>
                               <select class="custom-select"  id="team_id" name="team_id" required>
                                   <option value="">Select Team</option>
                                   @foreach($teams as $team)
                                       @php
                                           $selected = '';
                                           if($team->id == $new_hire_request->team_id){
                                               $selected = 'selected';
                                           }
                                       @endphp
                                       <option value="{{$team->id}}" {{$selected}}>{{$team->team}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="experience">Experience (In Months):</label>
                               <input class="form-control" type="number" name="experience" id="experience" required placeholder="Enter Required Experience" value="{{$new_hire_request->experience}}">
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="skills">Skills:</label>
                               <select class="custom-select"  id="skills" name="skills[]" required multiple>
                                   <option value="">Select Skills</option>
                                   @foreach($skills as $skill)
                                       @php
                                           $selected = '';
                                           if(in_array($skill->id,$nhr_skill)){
                                               $selected = 'selected';
                                           }
                                       @endphp
                                       <option value="{{$skill->id}}" {{$selected}}>{{$skill->skill}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label class="control-label" for="nhr_date">NHR Date</label>
                               <input class="form-control" type="text" name="nhr_date" id="nhr_date" required readonly value="{{Carbon\Carbon::parse($new_hire_request->created_at)->toDateString()}}">
                           </div>
                       </div>
                       <div class="col-md-6">
                           <label class="control-label form-text">Employee Type</label>
                           @php
                               $checked = '';
                               if($new_hire_request->employee_type == 1){
                                   $checked = 'checked';
                               }
                           @endphp
                           <div class="pretty p-default p-round">
                               <input type="radio" id="employee_type_full" name="employee_type" value="1" required {{$checked}}>
                               <div class="state">
                                   <label for="employee_type_full">Full Time</label>
                               </div>
                           </div>
                           @php
                               $checked = '';
                               if($new_hire_request->employee_type == 0){
                                   $checked = 'checked';
                               }
                           @endphp
                           <div class="pretty p-default p-round">
                               <input type="radio" id="employee_type_contract" name="employee_type" value="0" required {{$checked}}>
                               <div class="state">
                                   <label for="employee_type_contract">Contract</label>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-6">
                           <label class="control-label form-text">Billings</label>
                           @php
                               $checked = '';
                               if($new_hire_request->billing == 1){
                                   $checked = 'checked';
                               }
                           @endphp
                           <div class="pretty p-default p-round">
                               <input type="radio" id="billing_yes" name="billing" value="1" required {{$checked}}>
                               <div class="state">
                                   <label for="billing_yes">Billable</label>
                               </div>
                           </div>
                           @php
                               $checked = '';
                               if($new_hire_request->billing == 0){
                                   $checked = 'checked';
                               }
                           @endphp
                           <div class="pretty p-default p-round">
                               <input type="radio" id="billing_no" name="billing" value="0" required {{$checked}}>
                               <div class="state">
                                   <label for="billing_no">Non Billable</label>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label class="control-label" for="no_of_positions">No of Positions</label>
                               <input class="form-control" type="number" name="no_of_positions" id="no_of_positions" required value="{{$new_hire_request->no_of_positions}}">
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-6">
                           <label class="control-label form-text">Replacement</label>
                           @php
                               $checked = '';
                               if($new_hire_request->replacement == 1){
                                   $checked = 'checked';
                               }
                           @endphp
                           <div class="pretty p-default p-round">
                               <input type="radio" id="replacement_yes" name="replacement" value="1" required {{$checked}}>
                               <div class="state">
                                   <label for="replacement_yes">Yes</label>
                               </div>
                           </div>
                           @php
                               $checked = '';
                               if($new_hire_request->replacement == 0){
                                   $checked = 'checked';
                               }
                           @endphp
                           <div class="pretty p-default p-round">
                               <input type="radio" id="replacement_no" name="replacement" value="0" required {{$checked}}>
                               <div class="state">
                                   <label for="replacement_no">No</label>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label class="control-label" for="replacement_for">Replaced For:</label>
                               <select class="custom-select"  id="replacement_for" name="replacement_for[]" required multiple>
                                   <option value="">Select Replacements</option>
                                   @php
                                       $selected = '';
                                       if(in_array('NA',$nhr_replacement)){
                                           $selected = 'selected';
                                       }
                                   @endphp
                                   <option value="NA" {{$selected}}>Not Applicable</option>
                                   @foreach($users as $user)
                                       @php
                                           $selected = '';
                                           if(in_array($user->id,$nhr_replacement)){
                                               $selected = 'selected';
                                           }
                                       @endphp
                                       <option value="{{$user->id}}" {{$selected}}>{{$user->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="job_description">Job Description</label>
                               <textarea class="form-control" id="job_description" name="job_description" required>{{$new_hire_request->job_description}}</textarea>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
