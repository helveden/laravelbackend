<?php 

namespace Helveden\LBE\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RelationRepo;
use Illuminate\Database\Schema\Blueprint;
use Schema;


class RelationController extends LaravelBackendController  {
	
	public function index(){
		$relationrepo = new RelationRepo();
	}

	public function create(){

        if (!Schema::hasTable('relation')) {
            Schema::create('relation', function (Blueprint $table) {
                $table->increments('id');
                $table->string('table');
                $table->string('relation');
                $table->string('foreign_key');
                $table->string('class');
                $table->string('other_key');
            });
        }

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\TableController@show', ['table' => 'relation']
        );
	}

	public function show($id){
		$relationrepo = new RelationRepo();
	}

	public function store(Request $req, RelationRepo $relationrepo){

		$request = $req->all();

		$relationrepo->store($request);

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\TableController@show', ['table' => $request['table']]
        );
	}

	public function update($id, Request $req, RelationRepo $relationrepo){
		$request = $req->all();

		$relationrepo->update($id, $request);
		
        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\TableController@show', ['table' => $request['table']]
        );
	}

	public function destroy($id, RelationRepo $relationrepo){
		$relationrepo->destroy($id);
	}
	
}