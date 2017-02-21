<?php 

namespace Helveden\LBE\Http\Controllers;

use App\Http\Controllers\Controller;
use Schema;

class DatabaseController extends LaravelBackendController  {
	
	public function index(){

        $data = array();

        $data['relation'] = true;
        
        if (!Schema::hasTable('relation')) {
            $data['relation'] = false;
        }
        
        return view('back.database.index', $data);
	}
	
}