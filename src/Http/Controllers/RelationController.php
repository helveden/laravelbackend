<?php 

namespace Helveden\LBE\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RelationRepo;

class RelationController extends Controller  {
	
	public function index(){
		$relationrepo = new RelationRepo();
	}

	public function create(){

	}

	public function show($id){
		$relationrepo = new RelationRepo();
	}

	public function store(Request $req, RelationRepo $relationrepo){

		$request = $req->all();

		$relationrepo->store($request);

        return redirect()->action(
            'Back\\TableController@show', ['table' => $request['table']]
        );
	}

	public function update($id, Request $req, RelationRepo $relationrepo){
		$request = $req->all();

		$relationrepo->update($id, $request);
		
        return redirect()->action(
            'Back\\TableController@show', ['table' => $request['table']]
        );
	}

	public function destroy($id, RelationRepo $relationrepo){
		$relationrepo->destroy($id);
	}
	
}