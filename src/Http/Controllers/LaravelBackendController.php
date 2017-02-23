<?php 

namespace Helveden\LBE\Http\Controllers;

use App\Http\Controllers\Controller;

use Auth, Redirect;

class LaravelBackendController extends Controller {

    public $auth = false;
    
    public function __construct() {
        $this->middleware('auth');
    }
    
}