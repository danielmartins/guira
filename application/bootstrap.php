<?php

class GuiraUtils {
	
	public static function add2IncludePath($path2add){
		set_include_path(get_include_path() . PATH_SEPARATOR . $path2add );
	}
	
	public static function getControllerAndAction($url){
		$vars = explode("/", $url);
		$ctrlNext = false;
		$actionNext = false;
		foreach ($vars as $var) {
			if (!empty($var))
			{
				if($actionNext)
				{
					$action = $var;
					break;
				} 
				if ($ctrlNext)
				{
					$controller = $var;
					$actionNext = true; 
					continue;
				}
			}
			
			if ($var == "index.php")
				$ctrlNext = true;
		}
		return array("controller" => $controller, "action" => $action);
	}
	
}

function __autoload($name){
	require_once "$name.php";	
}

class Bootstrap{

	private static $default_controller = "IndexController";
	
	public static function configurePaths(){
		$appPath = dirname(__FILE__);
		
		$controllersPath = $appPath . DIRECTORY_SEPARATOR . "controllers";
		GuiraUtils::add2IncludePath($controllersPath);
		
		$modelsPath = $appPath . DIRECTORY_SEPARATOR . "models";
		GuiraUtils::add2IncludePath($modelsPath);
		
		$viewsPath = $appPath . DIRECTORY_SEPARATOR . "views";
		GuiraUtils::add2IncludePath(viewsPath);
	}
	
	public static function run($url){
		
		$info = GuiraUtils::getControllerAndAction($url);
		$controller = $info["controller"];
		$action = $info["action"];
		
		if(!is_null($controller)){
			self::configurePaths(); #configure paths
			$controller[0] = strtoupper($controller[0]);
			$controller = $controller . "Controller";
			$controllerObj = new $controller;
			var_dump($controllerObj);
		}
	}
}



