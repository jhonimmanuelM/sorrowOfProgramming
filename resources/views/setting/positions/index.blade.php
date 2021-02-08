@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Position</h4>
                    <a class="btn btn-success" href="{{ route('positions.create')}}"> Create New Position</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Position</th>
                            <th width="280px">Action</th>
                        </tr>
                        @if(count($positions) > 0)
                            @foreach ($positions as $key => $position)
                                <tr>
                                    <td>{{ $position->position }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('positions.edit',$position->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ route('positions.delete',$position->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" align="center">No Record Found</td>
                            </tr>
                        @endif
                    </table>
                    {!! $positions->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
