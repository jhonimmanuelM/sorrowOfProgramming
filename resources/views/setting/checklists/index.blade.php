@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Checklist</h4>
                    <a class="btn btn-success" href="{{ route('checklist.create')}}"> Create New Checklist</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Checklist</th>
                            <th>Role</th>
                            <th width="280px">Action</th>
                        </tr>
                        @if(count($checklists) > 0)
                            @foreach ($checklists as $key => $checklist)
                                <tr>
                                    <td>{{ $checklist->checklist }}</td>
                                    <td>{{ $checklist->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('checklist.edit',$checklist->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ route('checklist.delete',$checklist->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" align="center">No Record Found</td>
                            </tr>
                        @endif
                    </table>
                    {!! $checklists->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
