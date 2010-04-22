<?php

class Controller {
	
	const defaultTemplate = "layout.php";
	
	public function __construct(){
		$this->initView();
	}
	
	protected function initView($scriptFile = "")
	{
		if(empty($scriptFile)) $scriptFile = self::defaultTemplate;
		
		$this->view = new View($scriptFile);
	}
	
	public function __call($name, $arguments)
	{
		if(!method_exists($this, $name)){
			$this->page404();
		}
	} 
	
	public function page404()
	{
		$view = new View("404.php");
		$view->errorMessage = "TRetaaaaaa";
		$view->render();
	}
}