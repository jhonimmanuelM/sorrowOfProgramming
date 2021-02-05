<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TeamController extends Controller
{
    function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
    	$teams = DB::table('teams')->paginate(10);
    	return view('setting.teams.index',compact('teams'));
    }

    public function create(){
    	return view('setting.teams.create');
    }

    public function store(Request $request){
    	$check_for_unique = DB::table('teams')->where('team',$request->team)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered Team already available');
    	}

    	DB::table('teams')->insert([
    		'team' => $request->team,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('teams.index')->with('success','Team created successfully');
    }

    public function edit($id){
    	$team = DB::table('teams')->where('id',$id)->first();
    	return view('setting.teams.edit',compact('team'));
    }

    public function update(Request $request){
    	$check_for_unique = DB::table('teams')->where('id','!=',$request->id)->where('team',$request->team)->first();
    	if($check_for_unique){
    		return back()->with('failed','Entered Team already available');
    	}

    	DB::table('teams')->where('id',$request->id)->update([
    		'team' => $request->team,
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('teams.index')->with('success','Team updated successfully');
    }

    public function delete($id){
    	DB::table('teams')->where('id',$id)->delete();
    	return redirect()->route('teams.index')->with('success','Team deleted successfully');
    }
}
