<?php 

namespace Helveden\LBE\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Routing\Route;

class BackController extends Controller  {

	public function index(){
		
        return view('back.back', []);
	}
	
}