@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Checklist</h4>
                    <a class="btn btn-primary" href="{{ route('checklist.create')}}"> Create New Checklist</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th width="40%">Checklist</th>
                            <th width="40%">Role</th>
                            <th width="20%">Action</th>
                        </tr>
                        @if(count($checklists) > 0)
                            @foreach ($checklists as $key => $checklist)
                                <tr>
                                    <td>{{ $checklist->checklist }}</td>
                                    <td>{{ $checklist->name }}</td>
                                    <td class="table-custom-btn">
                                        <a class="btn btn-outline-warning rounded-btn" href="{{ route('checklist.edit',$checklist->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-outline-danger rounded-btn" href="{{ route('checklist.delete',$checklist->id) }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
