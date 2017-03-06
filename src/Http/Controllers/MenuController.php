<?php 

namespace Helveden\LBE\Http\Controllers;

use App\Menu;
use App\Repositories\MenuRepo;
use App\Repositories\MenuItemRepo;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;

class MenuController extends LaravelBackendController  {

    public function __construct() {

    }

	public function index(MenuRepo $menurepo, FormBuilder $formBuilder) {
		
        $data = array();

        $data['menus'] = collect($menurepo->get());

        $data['form'] = $formBuilder->create(\App\Forms\MenuForm::class, [
            'method' => 'POST',
            'url' => "back/comic/"
        ]);

        return view('back.menu.index', $data);
	}

	public function create() {

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@create'
        );

	} 

	public function store(Request $req) {

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

	}

	public function update($id, Request $req) {

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

	}

	public function show($id) {

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

	}

	public function delete($id) {

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

	}


}