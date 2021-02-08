@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        @include('general.alerts')
        <div class="card">
            {!! Form::open(array('route' => 'candidates.update','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}

            <div class="card-header">
                <h4>Cadidate - Edit</h4>
                <div class="card-btn">
                    <button type="submit" class="btn btn-success">Edit Candidate</button>
                    <a href="{{ route('candidates.index') }}">
                        <button type="button" class="btn btn-outline-secondary">Back</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" value="{{$candidate->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required value="{{$candidate->first_name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required value="{{$candidate->last_name}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="date_of_birth">DOB</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required  value="{{Carbon\Carbon::parse($candidate->date_of_birth)->toDateString()}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required value="{{$candidate->email}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="candidate_role">Position</label>
                            <select class="form-control"  id="candidate_role" name="candidate_role" required>
                                <option value="">Select Positions</option>
                                @foreach($position_collection as $position)
                                    @php
                                        $selected = '';
                                        if($position->id == $positions->id){
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
                            <label class="control-label" for="skills">Skills</label>
                            <div class="selectgroup selectgroup-pills">
                                @foreach($skills_collection as $skill)
                                    @php
                                        $checked = '';
                                        if(in_array($skill->id,$skills)){
                                            $checked = 'checked';
                                        }
                                    @endphp
                                    <label class="selectgroup-item">
                                        <input type="checkbox" value="{{$skill->id}}" class="selectgroup-input" name="skills[]" {{$checked}}>
                                        <span class="selectgroup-button">{{$skill->skill}}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="ctc">CTC</label>
                            <input type="number" class="form-control" id="ctc" name="ctc" required step="any" value="{{$candidate->ctc}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="ectc">ECTC</label>
                            <input type="number" class="form-control" id="ectc" name="ectc" required step="any" value="{{$candidate->ectc}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="notice_period">Notice Periods (In Days)</label>
                            <input type="number" class="form-control" id="notice_period" name="notice_period" required value="{{$candidate->notice_period}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="year_of_experience">Experience (In Months)</label>
                            <input type="number" class="form-control" id="year_of_experience" name="year_of_experience" required value="{{$candidate->year_of_experience}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="current_company_name">Current Company (Enter NA if not applicable)</label>
                            <input type="Text" class="form-control" id="current_company_name" name="current_company_name" required value="{{$candidate->current_company_name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="previous_company_name">Previous Company (Enter NA if not applicable)</label>
                            <input type="Text" class="form-control" id="previous_company_name" name="previous_company_name" required value="{{$candidate->previous_company_name}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="resume">Resume</label>
                            <input type="file" class="form-control" id="resume" name="resume">
                            <a class="form-text" href="{{url('/uploads')}}/{{$candidate->resume}}">Download Resume</a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
