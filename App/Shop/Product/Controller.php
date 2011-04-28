<?php

namespace App\Shop\Product;
use Shmvc\Helper\Text;

class Controller extends \Shmvc\Controller {
	public function __construct($name) {

		$this->header();
		echo 'product: ' . Text::escape(urldecode($name));
	}
}
