@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card author-box">
                <div class="card-header">
                    <h4 class="card-title"> Show User</h4>
                    <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">Back</a>
                </div>
                <div class="card-body">
                    <div class="author-box-center">
                        @if(Auth::user()->avatar)
                        <img alt="image" src="{{$user->avatar}}" class="rounded-circle author-box-picture">
                        @else
                            <img alt="image"  src="{{ asset('assets/img/user.png') }}"
                                 class="rounded-circle author-box-picture">
                        @endif
                        <div class="clearfix"></div>
                        <div class="author-box-name">
                            <a href="#">{{ $user->name }}</a>
                        </div>
                        <h6 class="mt-2 mb-2">{{ $user->email }}</h6>
                        <div class="author-box-job">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-primary">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
