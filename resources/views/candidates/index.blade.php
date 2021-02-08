@extends('layouts.app')
@section('content')
    @include('general.alerts')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Candidates</h4>
            <a class="btn btn-primary" href="{{ route('candidates.create')}}"> Add New Candidate</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
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
                                <td class="table-custom-btn">
                                    <a class="btn btn-outline-secondary rounded-btn" href="{{ route('candidates.view',$candidate->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-warning rounded-btn" href="{{ route('candidates.edit',$candidate->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @if($candidate->resume)
                                        <a class="btn btn-outline-danger rounded-btn" href="{{url('/uploads')}}/{{$candidate->resume}}">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                    <a class="btn btn-outline-danger rounded-btn"
                                       href="{{ route('candidates.delete',$candidate->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
@endsection
