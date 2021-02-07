<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4>NHR Request</h4>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-md-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <b>Role :</b> 
                  {{ $positions->position }}                        
                </li>
                <li class="list-group-item">
                  <b>Skills :</b> 
                  {{ implode(',',$skills) }}
                </li>
                <li class="list-group-item">
                  <b>Billings :</b> 
                  @if($new_hire_request->billing == 1)
                      Billable
                  @else
                      Non Billable
                  @endif              
                </li>                   
                <li class="list-group-item">
                  <b>Replacement for :</b> 
                  @if($new_hire_request->replacement_for == 'NA')
                      Not Applicable
                  @else
                      @php
                          $temp = $users->whereIn('id',$nhr_replacement);
                          $replacements = array();
                          foreach($temp as $replacment){
                              $replacements[] = $replacment->name;
                          }
                          $replacements = implode(",",$replacements);
                      @endphp
                      {{$replacements}}
                  @endif
                </li>
              </ul>
          </div>
          <div class="col-md-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <b>Team :</b> 
                  {{ $teams->team }}                        
                </li>
                <li class="list-group-item">
                  <b>NHR Created Date :</b> 
                  {{Carbon\Carbon::parse($new_hire_request->created_at)->toDateString()}}
                </li>                   
                <li class="list-group-item">
                  <b>No of Positions :</b> 
                  {{$new_hire_request->no_of_positions}}
                </li>
                <li class="list-group-item">
                  <b>Raised By :</b>
                  @php
                      $temp = $users->where('id',$new_hire_request->raised_by)->first();
                      if($temp){
                          $temp = $temp->name;
                      }else{
                          $temp = 'NA';
                      }
                  @endphp 
                  {{$temp}}
                </li>                   
              </ul>
          </div>
          <div class="col-md-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <b>Experience :</b> 
                  {{ $new_hire_request->experience }} Months                
                </li>
                <li class="list-group-item">
                  <b>Employee Type :</b> 
                  @if($new_hire_request->employee_type == 1)
                      Full Time
                  @else
                      Contract
                  @endif              
                </li>
                <li class="list-group-item">
                  <b>Replacement :</b> 
                  @if($new_hire_request->replacement == 1)
                      Yes
                  @else
                      No
                  @endif              
                </li>
                <li class="list-group-item">
                  <b>Approved By :</b>
                  @php
                      $temp = $users->where('id',$new_hire_request->approved_by)->first();
                      if($temp){
                          $temp = $temp->name;
                      }else{
                          $temp = 'NA';
                      }
                  @endphp 
                  {{$temp}}
                </li>                   
              </ul>
          </div>
          <div class="col-md-12">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <b>Job Description :</b> 
                  {{ $new_hire_request->job_description }}                        
                </li>
              </ul>
          </div>
      </div>
    </div>
  </div>
</div>