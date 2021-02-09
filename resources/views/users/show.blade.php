@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card author-box">
                <div class="card-header">
                    <h4 class="card-title"> Show User</h4>
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
                <div class="card-body">
                    <div class="author-box-center">
                    @if($user->avatar)
                    <img alt="image" src="{{$user->avatar}}" class="rounded-circle author-box-picture">
                        @else
                        <img alt="image" src="{{asset('assets/img/user.png')}}" class="rounded-circle author-box-picture">
                        @endif
                        <div class="clearfix"></div>
                        <div class="author-box-name">
                            <a href="#">{{ $user->name }}</a>
                        </div>
                        {{ $user->email }}
                        <div class="author-box-job">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                        <div>First Name:{{$user->first_name}}</div>
                        <div>Last Name:{{$user->last_name}}</div>
                        <div>Mobile:{{$user->mobile_number}}</div>
                        <div>Mobile:{{$user->mobile_number}}</div>
                        <div>Date Of Birth{{$user->DOB}}</div>
                        <div>Date Of Joining:{{$user->date_of_joining}}</div>
                        <div>Emergency Contact Name:{{$user->emergency_contact_name}}</div>
                        <div>Emergency Contact Number:{{$user->emergency_contact_number}}</div>
                        <div>Father Name:{{$user->father_name}}</div>
                        <div>Sprouse Name:{{$user->spouse_name}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
