@extends('layouts.app')


@section('content')
    @include('general.alerts')

    <div class="row">
        <div class="col-xl-3">
            @include('new_hire_request.nhr-details-in-card-minified')
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Candidates</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
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
                                                    <a href="{{ route('nhr.save-assign-candidate',[$new_hire_request->id,$candidate->id]) }}"
                                                       class="btn btn-outline-success rounded-btn"
                                                       data-toggle="tooltip" data-placement="bottom"
                                                       data-original-title="Assign"><i class=" fas fa-plus-square"></i></a>
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
                            {!! $candidates->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
