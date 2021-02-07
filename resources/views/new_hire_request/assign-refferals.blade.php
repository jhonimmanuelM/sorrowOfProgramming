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
            <h4>Refferals</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
             <tr>
               <th>Candidate Name</th>
               <th>Skills</th>
               <th>Experience</th>
               <th>Email</th>
               <th>Refered By</th>
               <th>Action</th>
            </tr>
            @if(count($referrals) > 0)
                @foreach ($referrals as $key => $referral)
                <tr>
                    <td>{{ $referral->candidate_name }}</td>
                    <td>
                        @php
                            $temp = $referral_skills->where('referral_id',$referral->id)->pluck('skill');
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
                    <td>
                      @php
                        $temp = $users->where('id',$referral->referred_by)->first();
                        if($temp){
                          $temp = $temp->name;
                        }else{
                          $temp = 'NA';
                        }
                      @endphp
                      {{$temp}}
                    </td>
                    <td>
                        @if($referral->resume)
                            <a class="btn btn-success" href="{{url('/uploads')}}/{{$referral->resume}}"><i class="fas fa-download"></i></a>
                        @endif
                        <a data-toggle="collapse" data-target="#viewInterviewFeedback{{$referral->id}}" aria-expanded="false" aria-controls="viewInterviewFeedback{{$referral->id}}" class="btn btn-success text-white"><i class="fas fa-plus-square"></i></a>
                    </td>
                </tr>
                <tr>
                <td colspan="7" align="center">
                  <div class="collapse" id="viewInterviewFeedback{{$referral->id}}">
                    @include('new_hire_request.refferals.refferal-to-candidate-conversion-form')
                  </div>
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
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>

@endsection