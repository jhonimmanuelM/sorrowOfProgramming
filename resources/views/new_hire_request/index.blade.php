@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>My NHR</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('nhr.create')}}">New NHR</a>
        </div>
    </div>
</div>

@include('general.alerts')

<table class="table table-bordered">
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
                    Created
                @elseif($new_hire_request->status == 2)
                    In-Progress 
                @elseif($new_hire_request->status == 3)
                    Candidates Selected
                @else
                    NHR Closed
                @endif
            </td>
            <td>
                <a class="btn btn-info" href="{{ route('nhr.view-progress',$new_hire_request->id) }}">View</a>
                @if($new_hire_request->status < 3)
                    <a class="btn btn-primary" href="{{ route('nhr.edit',$new_hire_request->id) }}">Edit</a>
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


{!! $new_hire_requests->render() !!}



@endsection