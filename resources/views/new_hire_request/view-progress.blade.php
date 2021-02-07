@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>NHR Candidate Progress</h4>
        </div>
    </div>
</div>


@include('general.alerts')

<div class="row">
  <div class="col-md-4">
    @include('new_hire_request.nhr-details-in-card-minified')
  </div>
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Recruiter</h4>
          </div>
          <div class="card-body">
            <p>
              @if($new_hire_request->status >= 2)
                @php
                  $temp = 'Not Available';
                  if($recruiter){
                    $temp = $users->where('id',$recruiter->employee_id)->first();
                    if($temp){
                      $temp = $temp->name;
                    }else{
                      $temp = 'Not Available';
                    }
                  }
                @endphp
                {{$temp}}
              @else
                Not Assigned Yet
              @endif
            </p>
          </div>
        </div>
      </div>  
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Candidates</h4>
            @if($new_hire_request->status == 2)
            <div class="card-header-action">
              <div class="dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Assign Candidate</a>
                <div class="dropdown-menu">
                  <a href="{{ route('nhr.assign-candidate',$new_hire_request->id) }}" class="dropdown-item has-icon"> Candidates</a>
                  <a href="{{ route('nhr.assign-refferal',$new_hire_request->id) }}" class="dropdown-item has-icon"> Referrals</a>
                </div>
              </div>
            </div>
            @endif
            <div class="card-header-action">            
              @if($new_hire_request->status == 3)
                <a href="{{ route('nhr.reopen',$new_hire_request->id) }}" class="btn btn-warning text-white">
                    Reopen NHR
                </a>
              @endif
            </div>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Candidate</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($nhr_candidates as $nhr_candidate)
                <tr>
                  <td>{{$nhr_candidate->first_name}} {{$nhr_candidate->last_name}}</td>
                  <td>{{$nhr_candidate->progress}}</td>
                  <td>
                    <a href="{{ route('nhr.view-nhr-candidate-progress',[$new_hire_request->id,$nhr_candidate->id]) }}" class="btn btn-primary text-white"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>  
            </table>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>

@endsection