@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('general.alerts')
            {!! Form::open(array('route' => 'users.checklists.save','method'=>'POST')) !!}
            <input type="hidden" name="employee_id" value="{{$user->id}}">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting - Checklist</h4>
                    <div class="card-btn">
                        <button type="submit" class="btn btn-success">Update Checklist</button>
                    </div>
                </div>
                <div class="card-body">
                    @include('setting.checklists.user-checklist-tabs')
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
