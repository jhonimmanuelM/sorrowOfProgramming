@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'referrals.update','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                <div class="card-header">
                    <h4 class="card-title">Referrals - Edit</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Update Referral</button>
                        <a href="{{ route('referrals.index') }}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" value="{{$referral->id}}" name="id">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="candidate_name">Candidate Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Candidate Name"
                                           id="candidate_name" name="candidate_name" required
                                           value="{{$referral->candidate_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="date_of_birth">DOB</label>
                                    <input type="date" class="form-control" placeholder="Enter DOB" id="date_of_birth"
                                           name="date_of_birth" value="{{$referral->date_of_birth}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="resume">Resume</label>
                                    <input type="file" class="form-control" placeholder="Enter Resume" id="resume"
                                           name="resume" accept=".pdf,.docx">
                                    <small class="form-text text-muted">Accept .pdf and .docx only</small>
                                    <a href="{{url('/uploads')}}/{{$referral->resume}}">Download</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="skills">Skills</label>
                                    <select size="3" class="custom-select" id="skills" name="skills[]" required multiple>
                                        <option value="">Select Skills</option>
                                        @foreach($skills as $skill)
                                            @php
                                                $selected = '';
                                                if(in_array($skill->id,$referral_skills)){
                                                    $selected = 'selected';
                                                }
                                            @endphp
                                            <option value="{{$skill->id}}" {{$selected}}>{{$skill->skill}}</option>
                                        @endforeach
                                        <option value="NA">Not Listed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="positions">Eligible for Positions</label>
                                    <select size="3" class="custom-select" id="positions" name="positions[]" required multiple>
                                        <option value="">Select Positions</option>
                                        @foreach($positions as $position)
                                            @php
                                                $selected = '';
                                                if(in_array($position->id,$referral_positions)){
                                                    $selected = 'selected';
                                                }
                                            @endphp
                                            <option
                                                value="{{$position->id}}" {{$selected}}>{{$position->position}}</option>
                                        @endforeach
                                        <option value="NA">Not Listed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Candidate Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Candidate Email"
                                           id="email"
                                           name="email" value="{{$referral->email}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="contact_number">Candidate Mobile Number</label>
                                    <input type="number" class="form-control"
                                           placeholder="Enter Candidate Mobile Number"
                                           id="contact_number" name="contact_number"
                                           value="{{$referral->contact_number}}"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="experience">Experience in Months</label>
                                    <input type="number" class="form-control" placeholder="Enter Experience in Months"
                                           id="experience" name="experience" value="{{$referral->experience}}" required>
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
