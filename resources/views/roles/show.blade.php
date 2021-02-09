@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Show Role</h4>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                </div>
                <div class="card-body">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <div>
                                        {{ $role->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Permissions</label>
                                  <div class="roles-badge">
                                      @if(!empty($rolePermissions))
                                          @foreach($rolePermissions as $v)
                                              <span class="badge badge-primary">{{ $v->name }}</span>
                                          @endforeach
                                      @endif
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
