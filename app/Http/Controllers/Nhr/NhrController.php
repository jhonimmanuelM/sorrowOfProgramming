<?php

namespace App\Http\Controllers\Nhr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class NhrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAll(){
    	$new_hire_requests = DB::table('new_hire_requests')->orderBy('updated_at','DESC')->paginate(10);
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
		return view('new_hire_request.all',compact('new_hire_requests','positions','skills','users','teams'));
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
}
