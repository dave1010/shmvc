<?php

namespace App\Shop;

class Controller extends \Shmvc\Controller {
	public function __construct() {
		$this->header();
		echo 'Shop controller. <a href="/shop/product/cheese">cheese</a> <a href="/shop/product/pie">pie</a>';
	}
}
