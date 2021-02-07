<?php

namespace App\Http\Controllers\Checklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;

class ChecklistController extends Controller
{
    function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
    	$checklists = DB::table('employee_checklists')->join('roles','roles.id','=','employee_checklists.role_id')->select('employee_checklists.*','roles.name')->paginate(10);
    	return view('setting.checklists.index',compact('checklists'));
    }

    public function create(){
    	$roles = DB::table('roles')->get();
    	return view('setting.checklists.create',compact('roles'));
    }

    public function store(Request $request){
    	DB::table('employee_checklists')->insert([
    		'role_id' => $request->role_id,
    		'checklist' => $request->checklist,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('checklist.index')->with('success','Checklist created successfully');
    }

    public function edit($id){
    	$checklist = DB::table('employee_checklists')->where('id',$id)->first();
    	$roles = DB::table('roles')->get();
    	return view('setting.checklists.edit',compact('checklist','roles'));
    }

    public function update(Request $request){
    	DB::table('employee_checklists')->where('id',$request->id)->update([
    		'role_id' => $request->role_id,
    		'checklist' => $request->checklist,
            'updated_at' => Carbon::now()
    	]);

    	return redirect()->route('checklist.index')->with('success','Checklist updated successfully');
    }

    public function delete($id){
    	DB::table('employee_checklists')->where('id',$id)->delete();
    	return redirect()->route('checklists.index')->with('success','Checklist deleted successfully');
    }

    public function userChecklist($user_id){
        $user = DB::table('users')->where('id',$user_id)->first();
        $checklists = DB::table('employee_checklists')->join('roles','roles.id','=','employee_checklists.role_id')->select('employee_checklists.*','roles.name')->get();
        $userchecklists = DB::table('employee_checklist_mappings')->where('employee_id',$user_id)->get();
        return view('setting.checklists.user-checklist',compact('user','checklists','userchecklists'));
    }

    public function saveUserChecklist(Request $request){
        $checklists = DB::table('employee_checklists')->whereIn('role_id',Auth::user()->roles->pluck('id')->toArray())->pluck('id')->toArray();
        DB::table('employee_checklist_mappings')->where('employee_id',$request->employee_id)->whereIn('employee_checklist_id',$checklists)->delete();
        foreach($request->checklist as $checklist){
            DB::table('employee_checklist_mappings')->insert([
                'employee_id' => $request->employee_id,
                'employee_checklist_id' => $checklist,
                'status' => 1
            ]);
        }
        return back()->with('success','Checklist updated successfully');
    }
}
