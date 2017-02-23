<?php 

namespace Helveden\LBE\Http\Controllers;

// use Illuminate\Routing\Route;
use Auth, Redirect;

class BackController extends LaravelBackendController  {
    
	public function index(){
        return view('back.back', []);
	}
	
}