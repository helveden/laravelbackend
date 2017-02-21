<?php 
/*http://laravel.sillo.org/creer-un-package/*/

namespace Helveden\LBE;

class LBE {

	public $pathback;

	public function __construct($pathback = 'back') {
		var_dump('LBE');die;
		$this->pathback = $pathback;
	}

}