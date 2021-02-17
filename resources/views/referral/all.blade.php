@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Referrals</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Candidate Name</th>
                                <th>Eligible Positions</th>
                                <th>Skills</th>
                                <th>Experience</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Refered By</th>
                                <th>Resume</th>
                            </tr>
                            @if(count($referrals) > 0)
                                @foreach ($referrals as $key => $referral)
                                    <tr>
                                        <td>{{ $referral->candidate_name }}</td>
                                        <td>
                                            @php
                                                $temp = $positions->where('referral_id',$referral->id)->pluck('position');
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
                                        <td>
                                            @php
                                                $temp = $skills->where('referral_id',$referral->id)->pluck('skill');
                                                if(!empty($temp) && $temp && $temp->count() > 0){
                                                    $temp_sklls = [];
                                                    foreach($temp as $tem){
                                                        $temp_sklls[] = $tem;
                                                    }
                                                    $temp = implode(",",$temp_sklls);
                                                }else{
                                                    $temp = '';
                                                }
                                            @endphp
                                            {{$temp}}
                                        </td>
                                        <td>{{ $referral->experience }} Months</td>
                                        <td>{{ $referral->email }}</td>
                                        <td>{{ $referral->contact_number }}</td>
                                        <td>{{ $refered_by[$referral->id] }}</td>
                                        <td>
                                            @if($referral->resume)
                                                <a class="btn btn-outline-danger rounded-btn" data-toggle="tooltip"
                                                   data-placement="bottom" data-original-title="Resume"
                                                   href="{{url('/uploads')}}/{{$referral->resume}}">
                                                    <i class="fas fa-file-pdf"></i>
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
                    {!! $referrals->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
