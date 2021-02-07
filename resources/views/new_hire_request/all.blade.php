@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>NHR</h2>
        </div>
    </div>
</div>

@include('general.alerts')

<table class="table table-bordered">
 <tr>
   <th>Team</th>
   <th>Raised By</th>
   <th>NHR Position</th>
   <!-- <th>Skills</th>
   <th>Experience</th>
   <th>Employeement Type</th>
   <th>Billable</th> -->
   <th>Status</th>
   <th>No of Positions</th>
   <th>Recruiter</th>
   <th>Action</th>
</tr>
@if(count($new_hire_requests) > 0)
    @foreach ($new_hire_requests as $key => $new_hire_request)
    <tr>
        <td>
            @php
                $team = $teams->where('id',$new_hire_request->team_id)->first();
                if($team){
                    $team = $team->team;
                }else{
                    $team = 'NA';
                }
            @endphp
            {{$team}}
        </td>
        <td>
            @php
                $user = $users->where('id',$new_hire_request->raised_by)->first();
                if($team){
                    $user = $user->name;
                }else{
                    $user = 'NA';
                }
            @endphp
            {{$user}}
        </td>
        <td>
            @php
                $temp = $positions->where('id',$new_hire_request->id)->pluck('position');
                if(!empty($temp) && $temp && $temp->count() > 0){
                    $temp_positions = [];
                    foreach($temp as $tem){
                        $temp_positions[] = $tem;
                    }
                    $temp = implode(",",$temp_positions);
                }else{
                    $temp = '';
                }
            @endphp
            {{$temp}}
        </td>
        <!-- <td>{{$skills[$new_hire_request->id]}}</td>
        <td>{{ $new_hire_request->experience }} Months</td>
        <td>
            @if($new_hire_request->employee_type == '1')
                Full Time
            @else
                Contract
            @endif
        </td>
        <td>
            @if($new_hire_request->employee_type == '1')
                Yes
            @else
                No
            @endif
        </td> -->
        <td>
            @if($new_hire_request->status == 1)
                Created
            @elseif($new_hire_request->status == 2)
                In-Progress 
            @elseif($new_hire_request->status == 3)
                Candidates Selected
            @else
                NHR Closed
            @endif
        </td>
        <td>{{ $new_hire_request->no_of_positions }}</td>
        <td>
            @if($new_hire_request->status < 2)
                Not Assigned
            @else
                @php
                    $temp = $recruiters->where('NHR_id',$new_hire_request->id)->first();
                    if($temp){
                        $temp = $temp->name;
                    }else{
                        $temp = 'NA';
                    }
                @endphp
                {{$temp}}
            @endif
        </td>
        <td>
            @if($new_hire_request->status == 1)
                @if(Auth::user()->hasRole('BBA'))
                <a class="btn btn-info" href="{{ route('nhr.assign-recruiter',$new_hire_request->id) }}">Assign Recruiter</a>
                @endif
            @endif
            @if($new_hire_request->status == 2 || $new_hire_request->status == 3)
                <a class="btn btn-info" href="{{ route('nhr.view-progress',$new_hire_request->id) }}">View</a>
            @endif
            @if($new_hire_request->status == 3 && Auth::user()->hasRole('BBA'))
                <a href="{{ route('nhr.reopen',$new_hire_request->id) }}" class="btn btn-warning text-white">
                    Reopen NHR
                </a>
                <a href="{{ route('nhr.final-close',$new_hire_request->id) }}" class="btn btn-success text-white">
                    Close NHR
                </a>
            @endif
        </td>
    </tr>
    @endforeach
@else
<tr>
    <td colspan="7" align="center">No Record Found</td>
</tr>
@endif
</table>


{!! $new_hire_requests->render() !!}



@endsection