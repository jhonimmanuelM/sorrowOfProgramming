@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            <div class="card">
                {!! Form::open(array('route' => 'checklist.store','method'=>'POST')) !!}
                <div class="card-header">
                    <h4 class="card-title">Setting - Checklist - Create</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Add Checklist</button>
                        <a href="{{ route('checklist.index') }}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Checklist</label>
                                <input type="text"
                                       class="form-control"
                                       id="checklist"
                                       name="checklist" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email">Checklist Role</label>
                                <select class="custom-select"
                                        id="role_id"
                                        name="role_id"
                                        required>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
