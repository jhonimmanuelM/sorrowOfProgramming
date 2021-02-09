@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Details</h4>
                    <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">Back</a>
                </div>
                <div class="card-body">
                    <p class="clearfix">
                        <span class="float-left">
                          First Name
                        </span>
                        <span class="float-right text-muted">
                          {{$user->first_name}}
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Last Name
                        </span>
                        <span class="float-right text-muted">
                          {{$user->last_name}}
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Mobile
                        </span>
                        <span class="float-right text-muted">
                         <a href="#"> {{$user->mobile_number}}</a>
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Date Of Birth
                        </span>
                        <span class="float-right text-muted">
                          <a href="#">{{$user->DOB}}</a>
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Date Of Joining
                        </span>
                        <span class="float-right text-muted">
                          <a href="#">{{$user->date_of_joining}}</a>
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Emergency Contact Name
                        </span>
                        <span class="float-right text-muted">
                         {{$user->emergency_contact_name}}
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                         Emergency Contact Number
                        </span>
                        <span class="float-right text-muted">
                         <a href="#">{{$user->emergency_contact_number}}</a>
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                         Father Name
                        </span>
                        <span class="float-right text-muted">
                         {{$user->father_name}}
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                         Spouse Name
                        </span>
                        <span class="float-right text-muted">
                         {{$user->spouse_name}}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card author-box">
                <div class="card-banner">
                    <img class="img-fluid" src="http://127.0.0.1:8000/assets/img/banner/bg-1.jpg">
                </div>
                <div class="card-body">
                    <div class="author-box-center">
                        @if($user->avatar)
                            <img alt="image" src="{{$user->avatar}}" class="rounded-circle author-box-picture">
                        @else
                            <img alt="image" src="{{asset('assets/img/user.png')}}"
                                 class="rounded-circle author-box-picture">
                        @endif
                        <div class="clearfix"></div>
                        <div class="author-box-name mt-5 mb-4 text-black-50">
                            <span class="author-box-name-text">
                                {{ $user->name }}
                            </span>
                        </div>
                        <div class="user-profile__details">
                            <h6 class="mt-2 mb-2">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                {{ $user->email }}
                            </h6>

                            <div class="author-box-job mt-3">
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <h6><i class="fas fa-briefcase"></i> {{ $v }}</h6>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
