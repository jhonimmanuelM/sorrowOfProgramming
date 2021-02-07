@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Skills</h4>
                    <a class="btn btn-success" href="{{ route('skills.create')}}"> Create New Skill</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Skill</th>
                            <th width="280px">Action</th>
                        </tr>
                        @if(count($skills) > 0)
                            @foreach ($skills as $key => $skill)
                                <tr>
                                    <td>{{ $skill->skill }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('skills.edit',$skill->id) }}">Edit</a>
                                        <a class="btn btn-danger"
                                           href="{{ route('skills.delete',$skill->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" align="center">No Record Found</td>
                            </tr>
                        @endif
                    </table>
                    {!! $skills->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
