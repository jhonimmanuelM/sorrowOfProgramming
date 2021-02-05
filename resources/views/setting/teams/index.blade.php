@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Setting - Teams</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('teams.create')}}"> Create New Team</a>
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
   <th>Team</th>
   <th width="280px">Action</th>
</tr>
@if(count($teams) > 0)
    @foreach ($teams as $key => $team)
    <tr>
        <td>{{ $team->team }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('teams.edit',$team->id) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('teams.delete',$team->id) }}">Delete</a>
        </td>
    </tr>
    @endforeach
@else
<tr>
    <td colspan="3" align="center">No Record Found</td>
</tr>
@endif
</table>


{!! $teams->render() !!}



@endsection