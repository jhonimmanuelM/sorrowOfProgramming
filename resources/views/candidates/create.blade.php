@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Cadidate - Create</h4>
        </div>
    </div>
</div>


@include('general.alerts')

{!! Form::open(array('route' => 'candidates.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
<div class="card">
  <div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_of_birth">DOB:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="candidate_role">Position:</label>
                <select class="form-control"  id="candidate_role" name="candidate_role" required>
                    <option value="">Select Positions</option>
                    @foreach($positions as $position)
                        <option value="{{$position->id}}">{{$position->position}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="skills">Skills:</label>
                <div class="selectgroup selectgroup-pills">
                    @foreach($skills as $skill)
                        <label class="selectgroup-item">
                            <input type="checkbox" value="{{$skill->id}}" class="selectgroup-input" name="skills[]">
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
                <label for="ctc">CTC:</label>
                <input type="number" class="form-control" id="ctc" name="ctc" required step="any">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ectc">ECTC:</label>
                <input type="number" class="form-control" id="ectc" name="ectc" required step="any">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="notice_period">Notice Periods (In Days)</label>
                <input type="number" class="form-control" id="notice_period" name="notice_period" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="year_of_experience">Experience (In Months):</label>
                <input type="number" class="form-control" id="year_of_experience" name="year_of_experience" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="current_company_name">Current Company (Enter NA if not applicable)</label>
                <input type="Text" class="form-control" id="current_company_name" name="current_company_name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="previous_company_name">Previous Company (Enter NA if not applicable)</label>
                <input type="Text" class="form-control" id="previous_company_name" name="previous_company_name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="resume">Resume</label>
                <input type="file" class="form-control" id="resume" name="resume" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Add Candidate</button>
            <a href="{{ route('candidates.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </div>
  </div>
</div>
{!! Form::close() !!}

@endsection