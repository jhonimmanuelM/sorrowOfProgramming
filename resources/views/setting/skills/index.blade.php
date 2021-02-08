@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Skills</h4>
                    <a class="btn btn-primary" href="{{ route('skills.create')}}"> Create New Skill</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th width="80%">Skill</th>
                            <th width="20%">Action</th>
                        </tr>
                        @if(count($skills) > 0)
                            @foreach ($skills as $key => $skill)
                                <tr>
                                    <td>{{ $skill->skill }}</td>
                                    <td class="table-custom-btn">
                                        <a class="btn btn-outline-warning rounded-btn" href="{{ route('skills.edit',$skill->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-outline-danger rounded-btn"
                                           href="{{ route('skills.delete',$skill->id) }}">
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
                    {!! $skills->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
