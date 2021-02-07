@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Candidates</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('candidates.create')}}"> Add New Candidate</a>
        </div>
    </div>
</div>


@include('general.alerts')


<div class="card">
  <div class="card-body">
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <!-- <th>DOB</th> -->
            <th>Email</th>
            <th>Position</th>
            <th>Skills</th>
            <th>CTC</th>
            <th>ECTC</th>
            <th>Notice Period</th>
            <th>Experience</th>
            <!-- <th>Current Company</th>
            <th>Previous Company</th> -->
            <th>Action</th>
        </tr>
        @if(count($candidates) > 0)
            @foreach ($candidates as $key => $candidate)
            <tr>
                <td>{{ $candidate->first_name }} {{ $candidate->last_name }}</td>
                <!-- <td>{{ Carbon\Carbon::parse($candidate->date_of_birth)->toDateString() }}</td> -->
                <td>{{ $candidate->email }}</td>
                <td>
                    @php
                        $temp = $positions->where('id',$candidate->id)->first();
                        if($temp){
                            $temp = $temp->position;
                        }else{
                            $temp = 'NA';
                        }
                    @endphp
                    {{ $temp }}
                </td>
                <td>{{ $skills[$candidate->id] }}</td>
                <td>{{ $candidate->ctc }}</td>
                <td>{{ $candidate->ectc }}</td>
                <td>{{ $candidate->notice_period }} Days</td>
                <td>{{ $candidate->year_of_experience }} Months</td>
                <!-- <td>{{ $candidate->current_company_name }}</td>
                <td>{{ $candidate->previous_company_name }}</td> -->
                <td>
                    <a class="btn btn-primary" href="{{ route('candidates.edit',$candidate->id) }}">Edit</a>
                    <a class="btn btn-primary" href="{{ route('candidates.view',$candidate->id) }}">View</a>
                @if($candidate->resume)
                    <a class="btn btn-success" href="{{url('/uploads')}}/{{$candidate->resume}}">Resume</a>
                @endif
                <a class="btn btn-danger" href="{{ route('candidates.delete',$candidate->id) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        @else
        <tr>
            <td colspan="12" align="center">No Record Found</td>
        </tr>
        @endif
    </table>
  </div>
</div>

{!! $candidates->render() !!}



@endsection