<?php 

namespace Helveden\LBE\Http\Controllers;

use App\Menu;
use App\Menu_item;
use App\Repositories\MenuRepo;
use App\Repositories\Menu_itemRepo;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;

class MenuController extends LaravelBackendController  {

    public $menurepo;
    public $menuitemrepo;

    public function __construct(MenuRepo $menurepo, Menu_itemRepo $menuitemrepo) {
        $this->menurepo = $menurepo;
        $this->menuitemrepo = $menuitemrepo;
    }

	public function index(MenuRepo $menurepo) {
		
        $data = array();

        $data['menus'] = collect($menurepo->get());

        return view('back.menu.index', $data);
	}

	public function create(FormBuilder $formBuilder) {

        $data['form'] = $formBuilder->create(\App\Forms\MenuForm::class, [
            'method' => 'POST',
            'url' => route('menu.store')
        ]);

        return view('back.menu.form', $data);

	} 

	public function store(Request $req) {

        $request = $req->all();
        $this->menurepo->store($request);

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

	}

    public function edit($id, FormBuilder $formBuilder) {

        $entity = $this->menurepo->getById($id);

        $data['form'] = $formBuilder->create(\App\Forms\MenuForm::class, [
            'method' => 'PUT',
            'url' => route('menu.update', ['id' => $id]),
            'model' => $entity
        ]);

        return view('back.menu.form', $data);

    }

	public function update($id, Request $req) {

        $request = $req->all();
        $this->menurepo->update($id, $request);

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

        $entity = $this->menurepo->getById($id);
        $this->menurepo->destroy($id);

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

	}

    public function itemEdit($id, FormBuilder $formBuilder) {

        $data['menus-item'] = collect($this->menurepo->get());

        $data['form_edit'] = array();

        $data['form'] = $formBuilder->create(\App\Forms\Menu_itemForm::class, [
            'method' => 'POST',
            'class'  => 'form-inline',
            'url' => route('menu.item.store', ['id' => $id])
        ])->add('menu_id', 'hidden', ['value' => $id]);

        $menuitems = Menu_item::where('menu_id', $id)->get();

        if (!empty($menuitems)) {
            foreach ($menuitems as $key => $item) {

                $entity = $this->menuitemrepo->getById($item->id);

                $data['form_edit'][] = $formBuilder->create(\App\Forms\Menu_itemForm::class, [
                        'method' => 'POST',
                        'class'  => 'form-inline',
                        'model'  => $entity,
                        'url' => route('menu.item.update', ['id' => $item->id])
                    ])->add('parent_id', 'hidden', ['value' => $id]);
            }
        }

        return view('back.menu.item-form', $data);
    }
    
    public function itemStore($id, Request $req) {

        $request = $req->all();

        $this->menuitemrepo->store($request);

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

    }
    
    public function itemUpdate($id, Request $req) {

        $request = $req->all();
        $this->menuitemrepo->update($id, $request);

        return redirect()->action(
            '\\Helveden\\LBE\\Http\\Controllers\\MenuController@index'
        );

    }
}
