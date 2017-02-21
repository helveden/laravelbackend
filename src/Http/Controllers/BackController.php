<?php 

namespace Helveden\LBE\Http\Controllers;

// use Illuminate\Routing\Route;
use Auth, Redirect;

class BackController extends LaravelBackendController  {
    
	public function index(){
        return view('back.back', []);
	}

	public function logout(){
		
		// Session::flush();
		Auth::logout();
		// auth()->logout();
	}
	
}