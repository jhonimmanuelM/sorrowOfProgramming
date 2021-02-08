@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'teams.store','method'=>'POST')) !!}
                <div class="card-header">
                    <h4 class="card-title">Setting - Teams - Create</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Add Team</button>
                        <a href="{{ route('teams.index') }}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Team</label>
                                <input type="text" class="form-control" placeholder="Enter a Team" id="team" name="team"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
