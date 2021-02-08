@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'teams.update','method'=>'POST')) !!}
                <div class="card-header">
                    <h4>Setting - Teams - Edit</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Update Team</button>
                        <a href="{{ route('teams.index') }}">
                            <button type="button" class="btn btn-warning">Back</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$team->id}}">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Team</label>
                                <input type="text" class="form-control" placeholder="Enter a Skill" id="team"
                                       name="team" required
                                       value="{{$team->team}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@endsection
