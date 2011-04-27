<?php

namespace App\Shop;

class Product extends \Shmvc\Controller {
	public function __construct($name) {
		$this->header();
		echo 'product: ' . $name;
	}
}
