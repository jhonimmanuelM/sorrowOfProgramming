{!! Form::open(array('route' => 'nhr.save.assign.refferal','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="nhr_id" value="{{$new_hire_request->id}}">
<input type="hidden" name="refferal_id" value="{{$referral->id}}">
<div class="row">
	<div class="col-md-6">
	  <div class="form-group">
	    <label>Candidate First Name</label>
	    <input type="text" class="form-control" id="first_name" name="first_name" required value="{{$referral->candidate_name}}">
	  </div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label>Last Name</label>
	    <input type="text" class="form-control" id="first_name" name="first_name" required>
	  </div>
	</div>
	<div class="col-md-4">
	  <div class="form-group">
	    <label>CTC</label>
	    <input type="number" class="form-control" id="ctc" name="ctc" required step="any">
	  </div>
	</div>
	<div class="col-md-4">
	  <div class="form-group">
	    <label>ECTC</label>
	    <input type="text" class="form-control" id="ectc" name="ectc" required step="any">
	  </div>
	</div>
	<div class="col-md-4">
	  <div class="form-group">
	    <label>Notice Period in Days</label>
	    <input type="text" class="form-control" id="notice_period" name="notice_period" required>
	  </div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label>Current Company</label>
	    <input type="text" class="form-control" id="current_company_name" name="current_company_name" required>
	  </div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label>Previous Company <sup>Enter NA if Not Applicable</sup></label>
	    <input type="text" class="form-control" id="previous_company_name" name="previous_company_name" required>
	  </div>
	</div>
	<div class="col-md-12">
	  <div class="form-group">
	    <button type="submit" class="btn btn-success">Add Refferals as Candidate</button>
	  </div>
	</div>
</div>
{!! Form::close() !!}