@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Role Management</h4>
                    @can('role-create')
                        <a class="btn btn-primary" href="{{ route('roles.create') }}"> Create New Role</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-outline-secondary rounded-btn" href="{{ route('roles.show',$role->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @can('role-edit')
                                    <!-- <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a> -->
                                @endcan
                                @can('role-delete')
                                    <!-- {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!} -->
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $roles->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
