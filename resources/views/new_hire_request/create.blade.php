@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'nhr.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                <div class="card-header">
                    <h4>NHR - Create</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Raise NHR</button>
                        <a href="{{ route('nhr.index') }}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="candidate_role_id">Role</label>
                                    <select class="custom-select" id="candidate_role_id" name="candidate_role_id"
                                            required>
                                        <option value="">Select Positions</option>
                                        @foreach($positions as $position)
                                            <option value="{{$position->id}}">{{$position->position}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="team_id">Teams</label>
                                    <select class="custom-select" id="team_id" name="team_id" required>
                                        <option value="">Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}">{{$team->team}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="experience">Experience (In Months)</label>
                                    <input class="form-control" type="number" name="experience" id="experience" required
                                           placeholder="Enter Required Experience">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="skills">Skills</label>
                                    <select class="custom-select" id="skills" name="skills[]" required multiple>
                                        <option value="">Select Skills</option>
                                        @foreach($skills as $skill)
                                            <option value="{{$skill->id}}">{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="nhr_date">NHR Date</label>
                                    <input class="form-control" type="text" name="nhr_date" id="nhr_date" required
                                           readonly
                                           value="{{Carbon\Carbon::now()->toDateString()}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label form-text">Employee Type</label>
                                <div class="pretty p-default p-round">
                                    <input type="radio" id="employee_type_full" name="employee_type" value="1" required>
                                    <div class="state">
                                        <label for="employee_type_full">Full Time</label>
                                    </div>
                                </div>

                                <div class="pretty p-default p-round">
                                    <input type="radio" id="employee_type_contract" name="employee_type" value="0"
                                           required>
                                    <div class="state">
                                        <label for="employee_type_contract">Contract</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label form-text">Billings</label>
                                <div class="pretty p-default p-round">
                                    <input type="radio" id="billing_yes" name="billing" value="1" required>
                                    <div class="state">
                                        <label for="billing_yes">Billable</label>
                                    </div>
                                </div>

                                <div class="pretty p-default p-round">
                                    <input type="radio" id="billing_no" name="billing" value="0" required>
                                    <div class="state">
                                        <label for="billing_no">Non Billable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="no_of_positions">No of Positions</label>
                                    <input class="form-control" type="number" name="no_of_positions"
                                           id="no_of_positions" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label form-text">Replacement</label>
                                <div class="pretty p-default p-round">
                                    <input type="radio" id="replacement_yes" name="replacement" value="1" required>
                                    <div class="state">
                                        <label for="replacement_yes">Yes</label>
                                    </div>
                                </div>
                                <div class="pretty p-default p-round">
                                    <input type="radio" id="replacement_no" name="replacement" value="0" required>
                                    <div class="state">
                                        <label for="replacement_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="replacement_for">Replaced For:</label>
                                    <select class="custom-select" id="replacement_for" name="replacement_for[]" required
                                            multiple>
                                        <option value="">Select Replacements</option>
                                        <option value="NA">Not Applicable</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="job_description">Job Description</label>
                                    <textarea class="form-control" id="job_description" name="job_description"
                                              required></textarea>
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
