@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>NHR Candidate</h4>
        </div>
    </div>
</div>

@include('general.alerts')

<div class="row">
    <div class="col-md-3">
    @include('new_hire_request.nhr-details-in-card-minified')
    </div>
    <div class="col-md-6">
        <div class="card card-info">
          <div class="card-header">
            <h4>Interview</h4>
            <div class="card-header-action">
                @if($new_hire_request->status == 2)
                    @if(count($interviews->where('status',1)) > 0)
                        <a href="{{ route('nhr.select-candidate',[$new_hire_request->id,$candidate->id]) }}" class="btn btn-success text-white">
                            Select This Candidate
                        </a>
                    @endif
                    @if(count($interviews->where('status',0)) == 0)
                        <a data-toggle="collapse" data-target="#scheduleInterviewCollapse" aria-expanded="false" aria-controls="scheduleInterviewCollapse" class="btn btn-primary text-white">
                            Schedule Interview
                        </a>
                    @endif
                @endif
            </div>
          </div>
          <div class="card-body">
            @include('new_hire_request.candidates.assign-interview')
            @include('new_hire_request.candidates.interviews')
          </div>
        </div>
    </div>
    
    <div class="col-md-3">
        @include('candidates.view-in-card')
    </div>
</div>

@endsection