<?php

namespace App\Shop\Product;

class Controller extends \Shmvc\Controller {
	public function __construct($name) {
		$this->header();
		echo 'product: ' . $name;
	}
}
