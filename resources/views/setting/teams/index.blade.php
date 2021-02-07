@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Teams</h4>
                    <a class="btn btn-success" href="{{ route('teams.create')}}"> Create New Team</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Team</th>
                            <th width="280px">Action</th>
                        </tr>
                        @if(count($teams) > 0)
                            @foreach ($teams as $key => $team)
                                <tr>
                                    <td>{{ $team->team }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('teams.edit',$team->id) }}">Edit</a>
                                        <a class="btn btn-danger"
                                           href="{{ route('teams.delete',$team->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" align="center">No Record Found</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! $teams->render() !!}
@endsection
