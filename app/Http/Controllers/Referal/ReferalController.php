<?php

namespace App\Http\Controllers\Referal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class ReferalController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
		// $this->middleware('permission:referral-list|referral-create|referral-edit|referral-delete', ['only' => ['index','show','getAll']]);
        // $this->middleware('permission:referral-create', ['only' => ['create','store']]);
        // $this->middleware('permission:referral-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:referral-delete', ['only' => ['delete']]);
    }

    public function getAll(){
    	$referrals = DB::table('referrals')->orderBy('updated_at','DESC')->paginate(10);
    	$positions = DB::table('employee_positions')->join('referral_position_mappings','referral_position_mappings.position_id','=','employee_positions.id')->whereIn('referral_position_mappings.referral_id',$referrals->pluck('id'))->select('referral_position_mappings.referral_id','employee_positions.position')->get();
    	$skills = DB::table('referal_skill_sets')->join('referral_skill_mappings','referral_skill_mappings.skill_id','=','referal_skill_sets.id')->whereIn('referral_skill_mappings.referral_id',$referrals->pluck('id'))->select('referral_skill_mappings.referral_id','referal_skill_sets.skill')->get();
    	$refered_by = array();
    	foreach($referrals as $referral){
    		$user = DB::table('users')->where('id',$referral->referred_by)->first();
    		if($user){
    			$refered_by[$referral->id] = $user->name;
    		}else{
    			$refered_by[$referral->id] = 'NA';
    		}
    	}
		return view('referral.all',compact('referrals','positions','skills','refered_by'));
    }

	public function index(){
    	$referrals = DB::table('referrals')->where('referred_by',Auth::user()->id)->orderBy('updated_at','DESC')->paginate(10);
    	$positions = DB::table('employee_positions')->join('referral_position_mappings','referral_position_mappings.position_id','=','employee_positions.id')->whereIn('referral_position_mappings.referral_id',$referrals->pluck('id'))->select('referral_position_mappings.referral_id','employee_positions.position')->get();
    	$skills = DB::table('referal_skill_sets')->join('referral_skill_mappings','referral_skill_mappings.skill_id','=','referal_skill_sets.id')->whereIn('referral_skill_mappings.referral_id',$referrals->pluck('id'))->select('referral_skill_mappings.referral_id','referal_skill_sets.skill')->get();
		return view('referral.index',compact('referrals','positions','skills'));
	}

	public function create(){
    	$positions = DB::table('employee_positions')->get();
    	$skills = DB::table('referal_skill_sets')->get();
    	return view('referral.create',compact('positions','skills'));
	}

	public function store(Request $request){
		$referal = DB::table('referrals')->insertGetId([
			'candidate_name' => $request->candidate_name,
			'date_of_birth' => Carbon::parse($request->date_of_birth)->now(),
			'email' => $request->email,
			'contact_number' => $request->contact_number,
			'experience' => $request->experience,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'referred_by' => Auth::user()->id
		]);

        $fileName = time().'.'.$request->resume->extension();  
        $request->resume->move(public_path('uploads'), $fileName);
        DB::table('referrals')->where('id',$referal)->update([
        	'resume' => $fileName
        ]);

		$insert_data = array();
		foreach($request->skills as $key => $skill){
			$insert_data[$key]['skill_id'] = $skill;
			$insert_data[$key]['referral_id'] = $referal;
			$insert_data[$key]['created_at'] = Carbon::now();
			$insert_data[$key]['updated_at'] = Carbon::now();
		}

		DB::table('referral_skill_mappings')->insert($insert_data);

		$insert_data = array();
		foreach($request->positions as $key => $position){
			$insert_data[$key]['position_id'] = $position;
			$insert_data[$key]['referral_id'] = $referal;
			$insert_data[$key]['created_at'] = Carbon::now();
			$insert_data[$key]['updated_at'] = Carbon::now();
		}

		DB::table('referral_position_mappings')->insert($insert_data);

		return redirect()->route('referrals.index')->with('success','Referral created successfully');
	}

	public function edit($id){
		$referral = DB::table('referrals')->where('id',$id)->first();
    	$positions = DB::table('employee_positions')->get();
    	$skills = DB::table('referal_skill_sets')->get();
    	$referral_positions = DB::table('referral_position_mappings')->where('referral_id',$id)->pluck('position_id')->toArray();
		$referral_skills = DB::table('referral_skill_mappings')->where('referral_id',$id)->pluck('skill_id')->toArray();
    	return view('referral.edit',compact('positions','skills','referral','referral_positions','referral_skills'));
	}

	public function update(Request $request){
		$referal = DB::table('referrals')->where('id',$request->id)->update([
			'candidate_name' => $request->candidate_name,
			'date_of_birth' => Carbon::parse($request->date_of_birth)->now(),
			'email' => $request->email,
			'contact_number' => $request->contact_number,
			'experience' => $request->experience,
			'updated_at' => Carbon::now(),
			'referred_by' => Auth::user()->id
		]);

		if($request->has('resume')){
	        $fileName = time().'.'.$request->resume->extension();  
	        $request->resume->move(public_path('uploads'), $fileName);
	        DB::table('referrals')->where('id',$request->id)->update([
	        	'resume' => $fileName
	        ]);
		}

        DB::table('referral_skill_mappings')->where('referral_id',$request->id)->delete();
		$insert_data = array();
		foreach($request->skills as $key => $skill){
			$insert_data[$key]['skill_id'] = $skill;
			$insert_data[$key]['referral_id'] = $referal;
			$insert_data[$key]['created_at'] = Carbon::now();
			$insert_data[$key]['updated_at'] = Carbon::now();
		}
		DB::table('referral_skill_mappings')->insert($insert_data);

		DB::table('referral_position_mappings')->where('referral_id',$request->id)->delete();
		$insert_data = array();
		foreach($request->positions as $key => $position){
			$insert_data[$key]['position_id'] = $position;
			$insert_data[$key]['referral_id'] = $referal;
			$insert_data[$key]['created_at'] = Carbon::now();
			$insert_data[$key]['updated_at'] = Carbon::now();
		}
		DB::table('referral_position_mappings')->insert($insert_data);

		return redirect()->route('referrals.index')->with('success','Referral Updated successfully');
	}

	public function delete($id){
		DB::table('referrals')->where('id',$id)->delete();
		DB::table('referral_skill_mappings')->where('referral_id',$id)->delete();
		DB::table('referral_position_mappings')->where('referral_id',$id)->delete();

		return redirect()->route('referrals.index')->with('success','Referral Deleted successfully');
	}
}
