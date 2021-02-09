@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Teams</h4>
                    <a class="btn btn-primary" href="{{ route('teams.create')}}"> Create New Team</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th width="80%">Team</th>
                            <th width="20%">Action</th>
                        </tr>
                        @if(count($teams) > 0)
                            @foreach ($teams as $key => $team)
                                <tr>
                                    <td>{{ $team->team }}</td>
                                    <td class="table-custom-btn">
                                        <a class="btn btn-outline-warning rounded-btn" data-toogle="tooltip" title="Edit" href="{{ route('teams.edit',$team->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-outline-danger rounded-btn" data-toogle="tooltip" title="Delete" href="{{ route('teams.delete',$team->id) }}">
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
                    {!! $teams->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
