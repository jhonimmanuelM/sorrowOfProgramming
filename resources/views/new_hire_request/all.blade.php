@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">NHR</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                                                <span class="badge badge-primary">Created</span>
                                            @elseif($new_hire_request->status == 2)
                                                <span class="badge badge-warning">In-Progress</span>
                                            @elseif($new_hire_request->status == 3)
                                                <span class="badge badge-success"> Candidates Selected</span>
                                            @else
                                                <span class="badge badge-secondary">NHR Closed</span>
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
                                                    <a class="btn btn-outline-success rounded-btn"
                                                       data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       data-original-title="Assign Recruiter"
                                                       href="{{ route('nhr.assign-recruiter',$new_hire_request->id) }}">
                                                        <i class="fas fa-user-plus"></i>
                                                    </a>
                                                @endif
                                            @endif
                                            @if($new_hire_request->status == 2 || $new_hire_request->status == 3)
                                                <a class="btn btn-outline-secondary rounded-btn"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   data-original-title="View"
                                                   href="{{ route('nhr.view-progress',$new_hire_request->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                            @if($new_hire_request->status == 3 && Auth::user()->hasRole('BBA'))
                                                <a href="{{ route('nhr.reopen',$new_hire_request->id) }}"
                                                   class="btn btn-outline-warning rounded-btn"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   data-original-title="Reopen NHR">
                                                    <i class="fas fa-book-reader"></i>
                                                </a>
                                                <a href="{{ route('nhr.final-close',$new_hire_request->id) }}"
                                                   class="btn btn-outline-danger rounded-btn"
                                                   data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   data-original-title=" Close NHR">
                                                    <i class="fas fa-times-circle"></i>
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
                    </div>
                    {!! $new_hire_requests->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
