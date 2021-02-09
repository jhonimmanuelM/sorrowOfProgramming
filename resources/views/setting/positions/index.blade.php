@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Position</h4>
                    <a class="btn btn-primary" href="{{ route('positions.create')}}"> Create New Position</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th width="80%">Position</th>
                            <th width="20%">Action</th>
                        </tr>
                        @if(count($positions) > 0)
                            @foreach ($positions as $key => $position)
                                <tr>
                                    <td>{{ $position->position }}</td>
                                    <td class="table-custom-btn">
                                        <a class="btn btn-outline-warning rounded-btn" data-toogle="tooltip" title="Edit" href="{{ route('positions.edit',$position->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-outline-danger rounded-btn" data-toogle="tooltip" title="Delete" href="{{ route('positions.delete',$position->id) }}">
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
                    {!! $positions->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
