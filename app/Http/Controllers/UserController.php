<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:user-create', ['only' => ['create','store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(10);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'gender_id' =>'required',
            'DOB' => 'required',
            'mobile_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $empId = User::orderBy('id','DESC')->first();
        $empId =$empId->employee_number + 1;
        $input = $request->all() + ['name' => $request->first_name.' '.$request->last_name,'employee_number' => $empId];
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required',
            'gender_id' =>'required',
            'DOB' => 'required',
            'mobile_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $input = $request->all() + ['name' => $request->first_name.' '.$request->last_name];

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function getProfile()
    {
        $user = User::find(AUTH::user()->id);
        return view('users.profile',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $id = AUTH::user()->id;
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
            'gender_id' =>'required',
            'DOB' => 'required',
            'mobile_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        if($request->hasFile('avatar_file')){
            $file = $request->file('avatar_file');
            $filename = $file->getClientOriginalName();
            $file->move('storage/photos', $filename);
            // $fullpath = $filename . '.' . $extension ; // adding full
            $avatar = "http://sop.dckap.co/"."storage/photos/".$filename;
            $input = $request->all() + ['name' => $request->first_name.' '.$request->last_name,'avatar' => $avatar];
            $user = User::find($id);
            $user->update($input);
        }else{
            $input = $request->all() + ['name' => $request->first_name.' '.$request->last_name];
            $user = User::find($id);
            $user->update($input);
        }
        return redirect()->back()
                        ->with('success','Profile Updated Successfully');
    }
    public function sendemail(){
        return view('mail.feedback');
//        $data = array('name'=>"jhon");
//        Mail::send('mail', $data, function($message) use($resp,$subject) {
//            $message->to($resp, 'Test Mail')->subject
//            ($subject);
//            $message->from('sorrowOfProgramming@gmail.com','SOP Team');
//        });
    }
}
