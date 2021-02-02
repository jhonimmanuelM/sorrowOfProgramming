<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class SkillController extends Controller
{
    function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
    	$skills = DB::table('referal_skill_sets')->paginate(10);
    	return view('setting.skills.index',compact('skills'));
    }

    public function create(){
    	return view('setting.skills.create');
    }

    public function store(Request $request){
    	$check_for_unique = DB::table('referal_skill_sets')->where('skill',$request->skill)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered skill already available');
    	}

    	DB::table('referal_skill_sets')->insert([
    		'skill' => $request->skill,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('skills.index')->with('success','Skill created successfully');
    }

    public function edit($id){
    	$skill = DB::table('referal_skill_sets')->where('id',$id)->first();
    	return view('setting.skills.edit',compact('skill'));
    }

    public function update(Request $request){
    	$check_for_unique = DB::table('referal_skill_sets')->where('id','!=',$request->id)->where('skill',$request->skill)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered skill already available');
    	}

    	DB::table('referal_skill_sets')->where('id',$request->id)->update([
    		'skill' => $request->skill,
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('skills.index')->with('success','Skill updated successfully');
    }

    public function delete($id){
    	DB::table('referal_skill_sets')->where('id',$id)->delete();
    	return redirect()->route('skills.index')->with('success','Skill deleted successfully');
    }
}
