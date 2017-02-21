<?php 

namespace Helveden\LBE\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntityController extends Controller  {
	
	public function index($class, $id = null){

		$entity = entity($class, $id);
		if (is_null($entity)) {
			$entity = 'Null';
		}
        return $entity;
	}
	
}