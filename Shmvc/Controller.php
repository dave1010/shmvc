<?php
namespace Shmvc;

class Controller {
	
	public function __construct() {
		echo 'Default SHMVC Controller';
	}

	private function class_name() {
		return get_class($this);
	}

	private function ns() {
		return str_replace('\Controller', '', get_class($this));
	}

	protected function header() {
		echo $this->view('header');
	}

	protected function view($view) {
		// load a view
		$view = 'View\\' . ucwords($view);
		$view = find_class($this->ns(), $view);
		if (empty($view)) {
			$view = 'Shmvc\View\NotFound';
		}

		return new $view;
	}

	protected function model() {
		// load a model
	}

	protected function request($route) {
		// hierachial
		ob_start();
		dispatch(route($this->ns() . $route));
		return ob_get_clean();
	}


}
