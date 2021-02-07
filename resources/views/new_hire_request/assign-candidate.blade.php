@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>NHR</h4>
        </div>
    </div>
</div>


@include('general.alerts')

<div class="row">
  <div class="col-md-3">
    @include('new_hire_request.nhr-details-in-card-minified')
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Candidates</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Skills</th>
                    <th>CTC</th>
                    <th>ECTC</th>
                    <th>Notice Period</th>
                    <th>Experience</th>
                    <th>Action</th>
                </tr>
                @if(count($candidates) > 0)
                    @foreach ($candidates as $key => $candidate)
                    <tr>
                        <td>{{ $candidate->first_name }} {{ $candidate->last_name }}</td>
                        <td>{{ $candidates_skills[$candidate->id] }}</td>
                        <td>{{ $candidate->ctc }}</td>
                        <td>{{ $candidate->ectc }}</td>
                        <td>{{ $candidate->notice_period }} Days</td>
                        <td>{{ $candidate->year_of_experience }} Months</td>
                        <td>
                          <a href="{{ route('nhr.save-assign-candidate',[$new_hire_request->id,$candidate->id]) }}" class="btn btn-primary text-white"><i class="fas fa-plus-square"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="12" align="center">No Record Found</td>
                </tr>
                @endif
            </table>
            {!! $candidates->render() !!}
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>

@endsection