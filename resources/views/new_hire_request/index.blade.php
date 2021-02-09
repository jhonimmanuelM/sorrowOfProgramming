@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-xl-12">
@include('general.alerts')
<div class="card">
<div class="card-header">
<h4 class="card-title">My NHR</h4>
<a class="btn btn-primary" href="{{ route('nhr.create')}}">New NHR</a>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th>NHR Position</th>
        <th>Skills</th>
        <th>Experience</th>
        <th>Employeement Type</th>
        <th>Billable</th>
        <th>No of Positions</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @if(count($new_hire_requests) > 0)
        @foreach ($new_hire_requests as $key => $new_hire_request)
            <tr>
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
                <td>{{$skills[$new_hire_request->id]}}</td>
                <td>{{ $new_hire_request->experience }} Months</td>
                <td>
                    @if($new_hire_request->employee_type == '1')
                        Full Time
                    @else
                        Contract
                    @endif
                </td>
                <td>
                    @if($new_hire_request->replacement == '1')
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>{{ $new_hire_request->no_of_positions }}</td>
                <td>
                    @if($new_hire_request->status == 1)
                        <span class="badge badge-primary">Created</span>
                    @elseif($new_hire_request->status == 2)
                        <span class="badge badge-warning">In-Progress</span>
                    @elseif($new_hire_request->status == 3)
                        <span class="badge badge-success">Candidates Selected</span>
                    @else
                        <span class="badge badge-secondary">NHR Closed</span>
                    @endif
                </td>
                <td class="table-custom-btn">
                    <a class="btn btn-outline-secondary rounded-btn" data-toogle="tooltip" title="View" href="{{ route('nhr.view-progress',$new_hire_request->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    @if($new_hire_request->status < 3)
                        <a class="btn btn-outline-secondary rounded-btn" data-toogle="tooltip" title="Edit" href="{{ route('nhr.edit',$new_hire_request->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    <!-- <a class="btn btn-danger" href="{{ route('nhr.delete',$new_hire_request->id) }}">Delete</a> -->
                    @else
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
