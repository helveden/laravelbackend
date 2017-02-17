<?php 

namespace Helveden\LBE\Src\Http\Controllers\Back;

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