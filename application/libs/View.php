<?php

class View {
	
	protected $file2render;
	
	public function __construct($file2render = "")
	{
		if(empty($file2render)) throw new Exception("Filename for view cannot be empty");
		$this->file2render = $file2render;
	}
	
	public function getNameOfScript(){
		return $this->file2render;
	}
	
	public function render()
	{
		include_once "{$this->file2render}";
	}
}