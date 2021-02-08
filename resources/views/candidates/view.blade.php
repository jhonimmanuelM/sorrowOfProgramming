@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-4">
            @include('general.alerts')
            <div class="card">
                <div class="card-header">
                    <h4>Cadidate - View</h4>
                    <a href="{{ route('candidates.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
                <div class="card-body">
                    @include('candidates.view-in-card')
                </div>
            </div>
        </div>
    </div>
@endsection
