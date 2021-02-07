@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h4>Cadidate - View</h4>
        </div>
        <div class="pull-right">
            <a href="{{ route('candidates.index') }}" class="btn btn-info">Back</a>
        </a>
    </div>
</div>


@include('general.alerts')

<div class="row">
    <div class="col-md-12">
        @include('candidates.view-in-card')
    </div>
</div>

@endsection