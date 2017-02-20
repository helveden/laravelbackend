<?php 

namespace Helveden\LBE\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Routing\Route;
use Auth, Session, Redirect;

class BackController extends Controller  {

	public function index(){
		
        return view('back.back', []);
	}

	public function logout(){
		
		// Session::flush();
		Auth::logout();
		// auth()->logout();

    	return Redirect::to(preg_replace("/:\/\//", "://log-me-out:fake-pwd@", url('/')));
	}
	
}