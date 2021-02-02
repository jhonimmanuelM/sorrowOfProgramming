<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PositionController extends Controller
{
    function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
    	$positions = DB::table('employee_positions')->paginate(10);
    	return view('setting.positions.index',compact('positions'));
    }

    public function create(){
    	return view('setting.positions.create');
    }

    public function store(Request $request){
    	$check_for_unique = DB::table('employee_positions')->where('position',$request->position)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered position already available');
    	}

    	DB::table('employee_positions')->insert([
    		'position' => $request->position,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('positions.index')->with('success','position created successfully');
    }

    public function edit($id){
    	$position = DB::table('employee_positions')->where('id',$id)->first();
    	return view('setting.positions.edit',compact('position'));
    }

    public function update(Request $request){
    	$check_for_unique = DB::table('employee_positions')->where('id','!=',$request->id)->where('position',$request->position)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered position already available');
    	}

    	DB::table('employee_positions')->where('id',$request->id)->update([
    		'position' => $request->position,
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('positions.index')->with('success','Skill updated successfully');
    }

    public function delete($id){
    	DB::table('employee_positions')->where('id',$id)->delete();
    	return redirect()->route('positions.index')->with('success','Skill deleted successfully');
    }
}
