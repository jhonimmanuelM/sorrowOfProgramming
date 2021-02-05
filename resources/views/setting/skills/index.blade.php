@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Setting - Skills</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('skills.create')}}"> Create New Skill</a>
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
   <th>Skill</th>
   <th width="280px">Action</th>
</tr>
@if(count($skills) > 0)
    @foreach ($skills as $key => $skill)
    <tr>
        <td>{{ $skill->skill }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('skills.edit',$skill->id) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('skills.delete',$skill->id) }}">Delete</a>
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



@endsection