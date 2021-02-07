<div class="row">
  <div class="col-12 col-sm-12 col-md-4">
    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
      @php
        $i=0;
      @endphp
      @foreach($checklists->unique('name')->pluck('name') as $role)
        @php
          $active = '';
          if($i == 0){
            $active = 'active';
          }
          $i++;
        @endphp
        <li class="nav-item">
          <a class="nav-link {{$active}}" id="home-tab{{$i}}" data-toggle="tab" href="#home{{$i}}" role="tab" aria-controls="home" aria-selected="true">{{$role}}</a>
        </li>
      @endforeach
    </ul>
  </div>
  <div class="col-12 col-sm-12 col-md-8">
    <div class="tab-content no-padding" id="myTab2Content">
      @php
        $i=0;
      @endphp
      @foreach($checklists->unique('name')->pluck('name') as $role)
        @php
          $active = '';
          if($i == 0){
            $active = 'active';
          }
          $i++;
        @endphp
        <div class="tab-pane fade show {{$active}}" id="home{{$i}}" role="tabpanel" aria-labelledby="home-tab{{$i}}">
          <table class="table">
            <thead>
              <tr>
                <th>Checked</th>
                <th>Checklist</th>
              </tr>
            </thead>
            <tbody>
              @foreach($checklists->where('name',$role) as $checklist)
              <tr>
                <td>
                  @php
                    $checked = '';
                    $temp = $userchecklists->where('employee_checklist_id',$checklist->id)->first();
                    if($temp){
                      $checked = 'checked';
                    }
                  @endphp
                  @if(Auth::user()->hasRole($role))
                    <div class="checkbox">
                      <label><input type="checkbox" value="{{$checklist->id}}" id="checlist{{$checklist->id}}" name="checklist[]" {{$checked}}></label>
                    </div>
                  @else
                    <div class="checkbox">
                      <label><input type="checkbox"  disabled {{$checked}}></label>
                    </div>
                  @endif
                </td>
                <td>{{$checklist->checklist}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endforeach
    </div>
  </div>
</div>