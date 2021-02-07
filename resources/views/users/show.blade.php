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
                        <img alt="image" src="{{$user->avatar}}" class="rounded-circle author-box-picture">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
