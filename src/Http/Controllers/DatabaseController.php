<?php 

namespace Helveden\LBE\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class DatabaseController extends Controller  {
	
	public function index(){

        return view('back.database.index', []);
	}
	
}