<?php

class IndexController extends  Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function testeAction($request){
		$this->view->title = "Teste";
		$this->view->render();
	}
}