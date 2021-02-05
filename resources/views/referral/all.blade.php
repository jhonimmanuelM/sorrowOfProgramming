@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Referrals</h2>
        </div>
    </div>
</div>


@include('general.alerts')



<table class="table table-bordered">
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
                <a class="btn btn-success" href="{{url('/uploads')}}/{{$referral->resume}}">Resume</a>
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


{!! $referrals->render() !!}



@endsection