<?php 

namespace Helveden\LBE\Http\Controllers\Back;

use App\Http\Controllers\Controller;
// use Illuminate\Routing\Route;

class BackController extends Controller  {
	
	public function index(){

		// // var_dump();die;
		// $routeCollection = \Route::getRoutes();

		// foreach ($routeCollection as $value) {
		//     // echo $value->getPath();
		//     // var_dump($value);
		// }
		// die;
		
        return view('back.back', []);
	}
	
}