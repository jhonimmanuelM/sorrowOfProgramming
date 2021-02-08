<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	if(Auth::user()->hasRole(['BBA','Recruiter','Interviewer'])){
    		return redirect()->route('nhr.all');
    	}elseif(Auth::user()->hasRole('TL')){
    		return redirect()->route('nhr.index');
    	}elseif(Auth::user()->hasRole('Employee')){
    		return redirect()->route('referrals.index');
    	}
    	// return view('dashboard.index');
    }
}
