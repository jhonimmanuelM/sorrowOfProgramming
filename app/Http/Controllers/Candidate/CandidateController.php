<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CandidateController extends Controller
{
    function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
    	$candidates = DB::table('candidates')->paginate(10);
    	$positions = DB::table('employee_positions')->join('candidates','candidates.candidate_role','=','employee_positions.id')->whereIn('candidates.candidate_role',$candidates->pluck('candidate_role'))->select('candidates.id','employee_positions.position')->get();
    	$skills_collection = DB::table('referal_skill_sets')->get();
    	$skills = array();
    	foreach($candidates as $candidate){
    		$temp = explode(',', $candidate->skills);
    		$temp = $skills_collection->whereIn('id',$temp)->pluck('skill');
    		$temp_skills = array();
    		foreach($temp as $temp_skil){
    			$temp_skills[] = $temp_skil;
    		}
    		$skills[$candidate->id] = implode(",", $temp_skills);
    	}
    	return view('candidates.index',compact('candidates','skills','positions'));
    }

    public function create(){
    	$positions = DB::table('employee_positions')->get();
    	$skills = DB::table('referal_skill_sets')->get();
    	return view('candidates.create',compact('positions','skills'));
    }

    public function store(Request $request){
    	$check_for_unique = DB::table('candidates')->where('email',$request->email)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered Candidate already available');
    	}
    	$candidate = DB::table('candidates')->insertGetId([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'date_of_birth' => $request->date_of_birth,
			'email' => $request->email,
			'candidate_role' => $request->candidate_role,
			'skills' => implode(',',$request->skills),
			'ctc' => $request->ctc,
			'ectc' => $request->ectc,
			'notice_period' => $request->notice_period,
			'year_of_experience' => $request->year_of_experience,
			'current_company_name' => $request->current_company_name,
			'previous_company_name' => $request->previous_company_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
    	]);
        $fileName = time().'.'.$request->resume->extension();  
        $request->resume->move(public_path('uploads'), $fileName);
        DB::table('candidates')->where('id',$candidate)->update([
        	'resume' => $fileName
        ]);
    	return redirect()->route('candidates.index')->with('success','candidate created successfully');
    }

    public function edit($id){
    	$candidate = DB::table('candidates')->where('id',$id)->first();
    	$position_collection = DB::table('employee_positions')->get();
    	$positions = DB::table('employee_positions')->join('candidates','candidates.candidate_role','=','employee_positions.id')->whereIn('candidates.candidate_role',$candidate->candidate_role)->select('candidates.id','employee_positions.position')->first();
    	$skills_collection = DB::table('referal_skill_sets')->get();
    	$skills = array();
		$temp = explode(',', $candidate->skills);
		$temp = $skills_collection->whereIn('id',$temp)->pluck('skill');
		$temp_skills = array();
		foreach($temp as $temp_skil){
			$temp_skills[] = $temp_skil;
		}
		$skills[$new_hire_request->id] = $temp_skil;
    	return view('candidates.edit',compact('candidate','skills_collection','skills','positions','position_collection'));
    }

    public function update(Request $request){
    	$check_for_unique = DB::table('candidates')->where('id','!=',$request->id)->where('email',$request->email)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered Candidate already available');
    	}

    	DB::table('candidates')->where('id',$request->id)->update([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'date_of_birth' => $request->date_of_birth,
			'email' => $request->email,
			'candidate_role' => $request->candidate_role,
			'skill_id' => implode(',',$request->skill_id),
			'ctc' => $request->ctc,
			'ectc' => $request->ectc,
			'notice_period' => $request->notice_period,
			'year_of_experience' => $request->year_of_experience,
			'current_company_name' => $request->current_company_name,
			'previous_company_name' => $request->previous_company_name,
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('candidates.index')->with('success','Candidate updated successfully');
    }

    public function delete($id){
    	DB::table('candidates')->where('id',$id)->delete();
    	return redirect()->route('candidates.index')->with('success','Candidate deleted successfully');
    }
}
