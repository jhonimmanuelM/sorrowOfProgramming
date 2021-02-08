@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'positions.store','method'=>'POST')) !!}
                <div class="card-header">
                    <h4 class="card-title">Setting - Positions - Create</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Add Position</button>
                        <a href="{{ route('positions.index') }}">
                            <button type="button" class="btn btn-warning">Cancel</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Position</label>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Enter a Skill"
                                       id="position"
                                       name="position" required>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
