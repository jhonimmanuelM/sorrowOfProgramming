@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Referrals - Edit</h4>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('failed'))
<div class="alert alert-danger">
  <p>{{ $message }}</p>
</div>
@endif
{!! Form::open(array('route' => 'referrals.update','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
    <input type="hidden" value="{{$referral->id}}" name="id">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="candidate_name">Candidate Name:</label>
                <input type="text" class="form-control" placeholder="Enter Candidate Name" id="candidate_name" name="candidate_name" required value="{{$referral->candidate_name}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="date_of_birth">DOB:</label>
                <input type="date" class="form-control" placeholder="Enter DOB" id="date_of_birth" name="date_of_birth" value="{{$referral->date_of_birth}}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="resume">Resume: <sup>Accept .pdf and .docx only</sup></label>
                <input type="file" class="form-control" placeholder="Enter Resume" id="resume" name="resume" accept=".pdf,.docx">
                <a href="{{url('/uploads')}}/{{$referral->resume}}">Download</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="skills">Skills:</label>
                <select class="form-control"  id="skills" name="skills[]" required multiple>
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="positions">Eligible for Positions:</label>
                <select class="form-control"  id="positions" name="positions[]" required multiple>
                    <option value="">Select Positions</option>
                    @foreach($positions as $position)
                        @php
                            $selected = '';
                            if(in_array($position->id,$referral_positions)){
                                $selected = 'selected';
                            }
                        @endphp
                        <option value="{{$position->id}}" {{$selected}}>{{$position->position}}</option>
                    @endforeach
                    <option value="NA">Not Listed</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="email">Candidate Email:</label>
                <input type="email" class="form-control" placeholder="Enter Candidate Email" id="email" name="email" value="{{$referral->email}}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="contact_number">Candidate Mobile Number:</label>
                <input type="number" class="form-control" placeholder="Enter Candidate Mobile Number" id="contact_number" name="contact_number" value="{{$referral->contact_number}}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="experience">Experience in Months:</label>
                <input type="number" class="form-control" placeholder="Enter Experience in Months" id="experience" name="experience" value="{{$referral->experience}}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Update Referral</button>
            <a href="{{ route('referrals.index') }}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </div>
{!! Form::close() !!}

@endsection