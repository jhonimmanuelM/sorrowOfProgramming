@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">NHR Progress</h4>
                    @if(Auth::user()->hasRole('TL'))
                        <a href="{{ route('nhr.index') }}" class="btn btn-outline-secondary">Back</a>
                    @else
                        <a href="{{ route('nhr.all') }}" class="btn btn-outline-secondary">Back</a>
                    @endif
                </div>

            </div>
        </div>
    </div>

    @include('general.alerts')

    <div class="row">
        <div class="col-xl-4">
            @include('new_hire_request.nhr-details-in-card-minified')
        </div>
        <div class="col-xl-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Recruiter</h4>
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
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Candidates</h4>
                            @if(Auth::user()->hasRole('Recruiter'))
                                <div class="card-header-action">
                                    @if($new_hire_request->status == 2 && $ongoing_interviews == 0  )
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Assign
                                                Candidate</a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('nhr.assign-candidate',$new_hire_request->id) }}"
                                                   class="dropdown-item has-icon"> Candidates</a>
                                                <a href="{{ route('nhr.assign-refferal',$new_hire_request->id) }}"
                                                   class="dropdown-item has-icon"> Referrals</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
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
                                                <a href="{{ route('nhr.view-nhr-candidate-progress',[$new_hire_request->id,$nhr_candidate->id]) }}"
                                                   class="btn btn-outline-secondary rounded-btn"
                                                   data-toggle="tooltip" data-placement="top" data-original-title="View"><i class="fas fa-eye"></i></a>
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
    </div>
@endsection
