@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Setting - Position</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('positions.create')}}"> Create New Position</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>Position</th>
   <th width="280px">Action</th>
</tr>
@if(count($positions) > 0)
    @foreach ($positions as $key => $position)
    <tr>
        <td>{{ $position->position }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('positions.edit',$position->id) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('positions.delete',$position->id) }}">Delete</a>
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



@endsection