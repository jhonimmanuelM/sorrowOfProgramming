@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users Management</h4>
                    <a class="btn btn-primary"
                       href="{{ route('users.create') }}">
                        Create New User
                    </a>
                </div>
                <div class="card-body">
                    @include('general.alerts')
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-primary">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="table-custom-btn">
                                        <a class="btn btn-outline-secondary rounded-btn" data-toggle="tooltip" data-placement="bottom" data-original-title="View"   href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye"></i></a>
                                        @if(Auth::user()->hasRole('BBA'))
                                            @if( $user->email != 'admin@blackbox.com' )
                                                <a class="btn btn-outline-warning rounded-btn" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit"  href="{{ route('users.edit',$user->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id]]) !!}
                                                {!! Form::submit('x', ['class' => 'btn btn-outline-danger rounded-btn']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                        @if(Auth::user()->hasRole(['BBA','TL','Recruiter']))
                                            <a class="btn btn-outline-success rounded-btn" data-toggle="tooltip" data-placement="bottom" data-original-title="Checklist" href="{{ route('users.checklists',$user->id) }}">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {!! $data->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
