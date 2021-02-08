<?php

namespace App\Http\Controllers\Nhr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;

class NhrController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
		// $this->middleware('permission:NHR-list|NHR-create|NHR-edit|NHR-delete', ['only' => ['index','show','getAll']]);
        // $this->middleware('permission:NHR-create', ['only' => ['create','store']]);
        // $this->middleware('permission:NHR-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:NHR-delete', ['only' => ['delete']]);
    }

    public function getAll(){
    	if(Auth::user()->hasRole('Interviewer')){
    		$interviewer_nhr = DB::table('candidate_interviews')->where('employee_id',Auth::user()->id)->where('status',0)->distinct('NHR_id')->pluck('NHR_id')->toArray();
	    	$new_hire_requests = DB::table('new_hire_requests')->where('status','!=',4)->whereIn('id',$interviewer_nhr)->orderBy('updated_at','DESC')->paginate(10);
    	}elseif(Auth::user()->hasRole('Recruiter')){
    		$recruiter_nhr = DB::table('new_hire_request_rrecruiters')->where('employee_id',Auth::user()->id)->distinct('NHR_id')->pluck('NHR_id')->toArray();
	    	$new_hire_requests = DB::table('new_hire_requests')->where('status','!=',4)->whereIn('id',$recruiter_nhr)->orderBy('updated_at','DESC')->paginate(10);
    	}else{
    		$new_hire_requests = DB::table('new_hire_requests')->where('status','!=',4)->orderBy('updated_at','DESC')->paginate(10);
    	}	
    	$positions = DB::table('employee_positions')->join('new_hire_requests','new_hire_requests.candidate_role_id','=','employee_positions.id')->whereIn('new_hire_requests.candidate_role_id',$new_hire_requests->pluck('candidate_role_id'))->select('new_hire_requests.id','employee_positions.position')->get();
    	$skills_collection = DB::table('referal_skill_sets')->get();
    	$skills = array();
    	foreach($new_hire_requests as $new_hire_request){
    		$temp = explode(',', $new_hire_request->skills);
    		$temp = $skills_collection->whereIn('id',$temp)->pluck('skill');
    		$temp_skills = array();
    		foreach($temp as $temp_skil){
    			$temp_skills[] = $temp_skil;
    		}
    		$skills[$new_hire_request->id] = implode(",", $temp_skills);
    	}
    	$teams = DB::table('teams')->whereIn('id',$new_hire_requests->pluck('team_id'))->get();
    	$users = DB::table('users')->whereIn('id',$new_hire_requests->pluck('raised_by'))->get();
    	$recruiters = DB::table('new_hire_request_rrecruiters')->whereIn('new_hire_request_rrecruiters.NHR_id',$new_hire_requests->pluck('id'))->join('users','users.id','=','new_hire_request_rrecruiters.employee_id')->select('new_hire_request_rrecruiters.NHR_id','users.name')->get();
		return view('new_hire_request.all',compact('new_hire_requests','positions','skills','users','teams','recruiters'));
    }

	public function index(){
    	$new_hire_requests = DB::table('new_hire_requests')->where('raised_by',Auth::user()->id)->orderBy('updated_at','DESC')->paginate(10);
    	$positions = DB::table('employee_positions')->join('new_hire_requests','new_hire_requests.candidate_role_id','=','employee_positions.id')->whereIn('new_hire_requests.candidate_role_id',$new_hire_requests->pluck('candidate_role_id'))->select('new_hire_requests.id','employee_positions.position')->get();
    	$skills_collection = DB::table('referal_skill_sets')->get();
    	$skills = array();
    	foreach($new_hire_requests as $new_hire_request){
    		$temp = explode(',', $new_hire_request->skills);
    		$temp = $skills_collection->whereIn('id',$temp)->pluck('skill');
    		$temp_skills = array();
    		foreach($temp as $temp_skil){
    			$temp_skills[] = $temp_skil;
    		}
    		$skills[$new_hire_request->id] = implode(",", $temp_skills);
    	}
    	$teams = DB::table('teams')->whereIn('id',$new_hire_requests->pluck('team_id'))->get();
		return view('new_hire_request.index',compact('new_hire_requests','positions','skills'));
	}

	public function create(){
    	$positions = DB::table('employee_positions')->get();
    	$skills = DB::table('referal_skill_sets')->get();
    	$teams = DB::table('teams')->get();
    	$users = DB::table('users')->get();
    	return view('new_hire_request.create',compact('positions','skills','teams','users'));
	}

	public function store(Request $request){
		DB::table('new_hire_requests')->insert([
			'candidate_role_id' => $request->candidate_role_id,
			'team_id' => $request->team_id,
			'experience' => $request->experience,
			'skills' => implode(',', $request->skills),
			'employee_type' => $request->employee_type,
			'billing' => $request->billing,
			'no_of_positions' => $request->no_of_positions,
			'job_description' => $request->job_description,
			'replacement' => $request->replacement,
			'replacement_for' => implode(',', $request->replacement_for),
			'approved_by' => Auth::user()->id,
			'raised_by' => Auth::user()->id,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
		return redirect()->route('nhr.index')->with('success','NHR created successfully');
	}

	public function edit($id){
		$new_hire_request = DB::table('new_hire_requests')->where('id',$id)->first();
    	$positions = DB::table('employee_positions')->get();
		$nhr_skill = explode(',', $new_hire_request->skills);
		$skills = DB::table('referal_skill_sets')->get();
    	$teams = DB::table('teams')->get();
    	$nhr_replacement = explode(',', $new_hire_request->replacement_for);
    	$users = DB::table('users')->get();
    	return view('new_hire_request.edit',compact('new_hire_request','positions','nhr_skill','skills','teams','nhr_replacement','users'));
	}

	public function update(Request $request){
		DB::table('new_hire_requests')->where('id',$request->id)->update([
			'candidate_role_id' => $request->candidate_role_id,
			'team_id' => $request->team_id,
			'experience' => $request->experience,
			'skills' => implode(',', $request->skills),
			'employee_type' => $request->employee_type,
			'billing' => $request->billing,
			'no_of_positions' => $request->no_of_positions,
			'job_description' => $request->job_description,
			'replacement' => $request->replacement,
			'replacement_for' => implode(',', $request->replacement_for),
			'approved_by' => Auth::user()->id,
			'raised_by' => Auth::user()->id,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);
		return redirect()->route('nhr.index')->with('success','NHR Updated successfully');
	}

	public function delete($id){
		DB::table('new_hire_requests')->where('id',$id)->delete();

		return redirect()->route('nhr.index')->with('success','NHR Deleted successfully');
	}

	public function assignRecruiter($id){
		$new_hire_request = DB::table('new_hire_requests')->where('id',$id)->first();
    	$positions = DB::table('employee_positions')->where('id',$new_hire_request->candidate_role_id)->first();
		$nhr_skill = explode(',', $new_hire_request->skills);
		$skills = DB::table('referal_skill_sets')->whereIn('id',$nhr_skill)->pluck('skill')->toArray();
    	$teams = DB::table('teams')->where('id',$new_hire_request->team_id)->first();
    	$nhr_replacement = explode(',', $new_hire_request->replacement_for);
    	$users = User::whereHas(
		    'roles', function($q){
		        $q->where('name', 'Recruiter');
		    }
		)->get();
    	return view('new_hire_request.assign-recruiter',compact('new_hire_request','positions','nhr_skill','skills','teams','nhr_replacement','users'));
	}

	public function saveAssignRecruiter(Request $request){

		DB::table('new_hire_request_rrecruiters')->insert([
			'employee_id' => $request->recruiter,
			'NHR_id' => $request->id
		]);

		DB::table('new_hire_requests')->where('id',$request->id)->update([
			'status' => 2
		]);
		return redirect()->route('nhr.all')->with('success','Recruiter assigned NHR Successfully');
	}

	public function viewProgress($id){
		$new_hire_request = DB::table('new_hire_requests')->where('id',$id)->first();
    	$positions = DB::table('employee_positions')->where('id',$new_hire_request->candidate_role_id)->first();
		$nhr_skill = explode(',', $new_hire_request->skills);
		$skills = DB::table('referal_skill_sets')->whereIn('id',$nhr_skill)->pluck('skill')->toArray();
    	$teams = DB::table('teams')->where('id',$new_hire_request->team_id)->first();
    	$nhr_replacement = explode(',', $new_hire_request->replacement_for);
    	$users = DB::table('users')->get();
    	$recruiter = DB::table('new_hire_request_rrecruiters')->where('NHR_id',$id)->first();
    	if(Auth::user()->hasRole('Interviewer')){
    		$interviewer_nhr = DB::table('candidate_interviews')->where('employee_id',Auth::user()->id)->where('status',0)->distinct('candidate_id')->pluck('candidate_id')->toArray();
	    	$nhr_candidates = DB::table('candidate_new_hire_requests')->join('candidates','candidates.id','=','candidate_new_hire_requests.candidate_id')->whereIn('candidate_new_hire_requests.candidate_id',$interviewer_nhr)->select('candidates.id','candidates.first_name','candidates.last_name','candidate_new_hire_requests.progress')->paginate(10);
	    }else{
	    	if($new_hire_request->status == 3){
		    	$nhr_candidates = DB::table('candidate_new_hire_requests')->where('candidate_new_hire_requests.NHR_id',$id)->where('candidate_new_hire_requests.status',1)->join('candidates','candidates.id','=','candidate_new_hire_requests.candidate_id')->select('candidates.id','candidates.first_name','candidates.last_name','candidate_new_hire_requests.progress')->paginate(10);
	    	}else{
		    	$nhr_candidates = DB::table('candidate_new_hire_requests')->where('candidate_new_hire_requests.NHR_id',$id)->join('candidates','candidates.id','=','candidate_new_hire_requests.candidate_id')->select('candidates.id','candidates.first_name','candidates.last_name','candidate_new_hire_requests.progress')->paginate(10);
	    	}
	    }
	    $ongoing_interviews = DB::table('candidate_interviews')->where('NHR_id',$id)->where('status',0)->count();
    	return view('new_hire_request.view-progress',compact('new_hire_request','positions','nhr_skill','skills','teams','nhr_replacement','users','recruiter','nhr_candidates','ongoing_interviews'));
	}

	public function assignCandidate($id){
		$new_hire_request = DB::table('new_hire_requests')->where('id',$id)->first();
    	$positions = DB::table('employee_positions')->where('id',$new_hire_request->candidate_role_id)->first();
		$nhr_skill = explode(',', $new_hire_request->skills);
		$skills = DB::table('referal_skill_sets')->whereIn('id',$nhr_skill)->pluck('skill')->toArray();
    	$teams = DB::table('teams')->where('id',$new_hire_request->team_id)->first();
    	$nhr_replacement = explode(',', $new_hire_request->replacement_for);
    	$users = DB::table('users')->get();
    	$recruiter = DB::table('new_hire_request_rrecruiters')->where('NHR_id',$id)->first();
    	$candidates = DB::table('candidates')->where('candidate_role',$new_hire_request->candidate_role_id);
    	$i = 0;
    	foreach($nhr_skill as $hr_skill){
    		if($i == 0){
	    		$candidates = $candidates->orWhere('skills','like','%'.$hr_skill.'%');
    		}else{
	    		$candidates = $candidates->orWhere('skills','like','%'.$hr_skill.'%');
    		}
    		$i++;
    	}
    	$candidates = $candidates->paginate(10);
		$referal_skill_sets = DB::table('referal_skill_sets')->get();
    	$candidates_skills = array();
    	foreach($candidates as $candidate){
    		$temp = explode(',', $candidate->skills);
    		$temp = $referal_skill_sets->whereIn('id',$temp)->pluck('skill');
    		$temp_skills = array();
    		foreach($temp as $temp_skil){
    			$temp_skills[] = $temp_skil;
    		}
    		$candidates_skills[$candidate->id] = implode(",", $temp_skills);
    	}
    	return view('new_hire_request.assign-candidate',compact('new_hire_request','positions','nhr_skill','skills','teams','nhr_replacement','users','recruiter','candidates','referal_skill_sets','candidates_skills'));
	}

	public function saveAssignCandidate($nhr_id,$candidate_id){
		
		DB::table('candidate_new_hire_requests')->insert([
			'candidate_id' => $candidate_id,
			'NHR_id' => $nhr_id,
			'progress' => 'Interview Not Assigned Yet',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		]);

		return redirect()->route('nhr.view-progress',[$nhr_id])->with('success','Candidate is added successfully');
	}

	public function viewNHRCandidateProgress($nhr_id,$candidate_id){
		$new_hire_request = DB::table('new_hire_requests')->where('id',$nhr_id)->first();
    	$positions = DB::table('employee_positions')->where('id',$new_hire_request->candidate_role_id)->first();
		$skills = explode(',', $new_hire_request->skills);
		$skills = DB::table('referal_skill_sets')->whereIn('id',$skills)->pluck('skill')->toArray();
    	$teams = DB::table('teams')->where('id',$new_hire_request->team_id)->first();
    	$nhr_replacement = explode(',', $new_hire_request->replacement_for);
    	$users = DB::table('users')->get();
    	$candidate = DB::table('candidates')->where('id',$candidate_id)->first();
    	$position_collection = DB::table('employee_positions')->get();
    	$candidate_positions = DB::table('employee_positions')->join('candidates','candidates.candidate_role','=','employee_positions.id')->where('employee_positions.id',$candidate->candidate_role)->select('employee_positions.id','employee_positions.position')->first();
    	$skills_collection = DB::table('referal_skill_sets')->get();
    	$candidate_skills = explode(',', $candidate->skills);
    	$interviews = DB::table('candidate_interviews')->where('NHR_id',$nhr_id)->where('candidate_id',$candidate_id)->get();
    	$interviewers = User::whereHas(
		    'roles', function($q){
		        $q->where('name', 'Interviewer');
		    }
		)->get();
    	return view('new_hire_request.candidates.progress',compact('candidate','skills_collection','candidate_positions','candidate_skills','position_collection','positions','skills','new_hire_request','teams','nhr_replacement','users','interviews','interviewers'));
	}

	public function scheduleInterview(Request $request){
		DB::table('candidate_interviews')->insert([
			'candidate_id' => $request->candidate_id,
			'NHR_id' => $request->NHR_id,
			'employee_id' => $request->employee_id,
			'interview_type' => $request->interview_type,
			'scheduled_at' => Carbon::parse($request->scheduled_at)->toDateTimeString()
		]);

		DB::table('candidate_new_hire_requests')->where('candidate_id',$request->candidate_id)->where('NHR_id',$request->NHR_id)->update([
			'progress' => 'Interview Schedule At'.Carbon::parse($request->scheduled_at)->toDateTimeString()
		]);

		return back()->with('success','Interview Schedulded Successfully');
	}

	public function editInterview(Request $request){
		if($request->has('status') && $request->has('feedback')){
			DB::table('candidate_interviews')->where('id',$request->id)->update([
				'status' => $request->status,
				'feedback' => $request->feedback
			]);
			if($request->status == 1){
				DB::table('candidate_new_hire_requests')->where('candidate_id',$request->candidate_id)->where('NHR_id',$request->NHR_id)->update([
					'progress' => 'Forwarded to Next Round By '.Auth::user()->name
				]);
			}else{
				DB::table('candidate_new_hire_requests')->where('candidate_id',$request->candidate_id)->where('NHR_id',$request->NHR_id)->update([
					'progress' => 'Eliminated By '.Auth::user()->name,
					'status' => 2
				]);
			}

			return back()->with('success','Interview Updated Successfully');
		}else{
			DB::table('candidate_interviews')->where('id',$request->id)->update([
				'candidate_id' => $request->candidate_id,
				'NHR_id' => $request->NHR_id,
				'employee_id' => $request->employee_id,
				'interview_type' => $request->interview_type,
				'scheduled_at' => Carbon::parse($request->scheduled_at)->toDateTimeString()
			]);

			DB::table('candidate_new_hire_requests')->where('candidate_id',$request->candidate_id)->where('NHR_id',$request->NHR_id)->update([
				'progress' => 'Interview Schedule At'.Carbon::parse($request->scheduled_at)->toDateTimeString()
			]);

			return back()->with('success','Interview Updated Successfully');
		}
	}

	public function deleteInterview($id){
		DB::table('candidate_interviews')->where('id',$id)->delete();
		return back()->with('success','Interview Deleted Successfully');
	}

	public function selectNHRCandidate($nhr_id,$candidate_id){
		$nhr = DB::table('new_hire_requests')->where('id',$nhr_id)->first();
		$candidate = DB::table('candidate_new_hire_requests')->where('candidate_id',$candidate_id)->where('NHR_id',$nhr_id)->update([
			'progress' => 'Candidate Shortlisted',
			'status' => 1
		]);
		$selectedCandidate = DB::table('candidate_new_hire_requests')->where('NHR_id',$nhr_id)->where('status',1)->count();
		if($selectedCandidate == $nhr->no_of_positions){
			DB::table('new_hire_requests')->where('id',$nhr_id)->update([
				'status' => 3
			]);
			return redirect()->route('nhr.view-progress',[$nhr_id])->with('success','Candidate is Selected and NHR is closed successfully');
		}else{
			return redirect()->route('nhr.view-progress',[$nhr_id])->with('success','Candidate is Selected successfully');
		}
	}

	public function reopenNHR($nhr_id){
		$nhr = DB::table('new_hire_requests')->where('id',$nhr_id)->first();
		$candidates = DB::table('candidate_new_hire_requests')->where('status',1)->where('NHR_id',$nhr_id)->update([
			'progress' => 'Candidate Unable to Join',
			'status' => 2
		]);
		DB::table('new_hire_requests')->where('id',$nhr_id)->update([
			'status' => 2
		]);
		return back()->with('success','NHR is reopened successfully');
	}

	public function assignRefferal($id){
		$new_hire_request = DB::table('new_hire_requests')->where('id',$id)->first();
    	$positions = DB::table('employee_positions')->where('id',$new_hire_request->candidate_role_id)->first();
		$nhr_skill = explode(',', $new_hire_request->skills);
		$skills = DB::table('referal_skill_sets')->whereIn('id',$nhr_skill)->pluck('id')->toArray();
    	$teams = DB::table('teams')->where('id',$new_hire_request->team_id)->first();
    	$nhr_replacement = explode(',', $new_hire_request->replacement_for);
    	$users = DB::table('users')->get();
    	$skills_refferals_id = DB::table('referral_skill_mappings')->whereIn('skill_id',$skills)->pluck('referral_id')->toArray();
    	$referrals = DB::table('referrals')->whereIn('id',$skills_refferals_id)->orderBy('updated_at','DESC')->paginate(10);
    	$referral_skills = DB::table('referal_skill_sets')->join('referral_skill_mappings','referral_skill_mappings.skill_id','=','referal_skill_sets.id')->whereIn('referral_skill_mappings.referral_id',$referrals->pluck('id'))->select('referral_skill_mappings.referral_id','referal_skill_sets.skill')->get();
    	return view('new_hire_request.assign-refferals',compact('new_hire_request','positions','nhr_skill','skills','teams','nhr_replacement','users','referrals','referral_skills'));
	}

	public function saveAssignRefferal(Request $request){
		$refferal = DB::table('referrals')->where('id',$request->refferal_id)->first();
		$referal_skills = DB::table('referral_skill_mappings')->where('referral_id',$request->refferal_id)->pluck('skill_id')->toArray();
		$refferal_position = DB::table('referral_position_mappings')->where('referral_id',$request->refferal_id)->first();

		$check_for_unique = DB::table('candidates')->where('email',$refferal->email)->first();
    	if($check_for_unique){
			DB::table('candidate_new_hire_requests')->insert([
				'candidate_id' => $check_for_unique->id,
				'NHR_id' => $request->nhr_id,
				'progress' => 'Interview Not Assigned Yet',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]);

			return redirect()->route('nhr.view-progress',[$request->nhr_id])->with('success','Candidate is added successfully');
    	}else{
    		$candidate_id = DB::table('candidates')->insertGetId([
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'date_of_birth' => $refferal->date_of_birth,
				'email' => $refferal->email,
				'candidate_role' => $refferal_position->position_id,
				'skills' => implode(',',$referal_skills),
				'ctc' => $request->ctc,
				'ectc' => $request->ectc,
				'notice_period' => $request->notice_period,
				'year_of_experience' => $refferal->experience,
				'current_company_name' => $request->current_company_name,
				'previous_company_name' => $request->previous_company_name,
				'resume' => $refferal->resume,
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	    	]);

	    	DB::table('referral_candidate_mappings')->insert([
				'candidate_id' => $candidate_id,
				'referral_id' => $refferal->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
	    	]);

			DB::table('candidate_new_hire_requests')->insert([
				'candidate_id' => $candidate_id,
				'NHR_id' => $request->nhr_id,
				'progress' => 'Interview Not Assigned Yet',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]);

			return redirect()->route('nhr.view-progress',[$request->nhr_id])->with('success','Candidate is added successfully');
    	}
	}

	public function closeNHR($nhr_id){
		$candidates = DB::table('candidate_new_hire_requests')->where('candidate_new_hire_requests.NHR_id',$nhr_id)->where('candidate_new_hire_requests.status',1)->join('candidates','candidates.id','=','candidate_new_hire_requests.candidate_id')->select('candidates.*')->get();
		// dump($candidates);
		foreach($candidates as $candidate){
			$empId = User::orderBy('id','DESC')->first();
        	$empId =$empId->employee_number + 1;
	        $user = User::create([
	            'name'    => $candidate->first_name.' '.$candidate->last_name,
	            'first_name'    => $candidate->first_name,
	            'last_name'    => $candidate->last_name,
	            'email' => $candidate->email,
	            'employee_number'    => $empId,
	            'status'    => '1',
	            'date_of_joining'    => Carbon::now(),
	            'password'      => '$2y$10$GFyeGJrmd9VJrellIGfmCu3lmvO26indLDc8n/Xl3tbiRWqq7JJAi',
	            'created_at'    => Date('Y-m-d H:i:s'),
	            'updated_at'    => Date('Y-m-d H:i:s')
	        ]);
	        $user->assignRole([5]);
		}
		DB::table('new_hire_requests')->where('id',$nhr_id)->update([
			'status' => 4
		]);
		return redirect()->route('nhr.all')->with('success','Recruiter assigned NHR Successfully');
	}
}
