<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		$autoloader = new Zend_Application_Module_Autoloader(array(
	            'namespace' => '',
	            'basePath'  => dirname(__FILE__),
		));
	
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace('My_');
	
		return $autoloader;
	}

  protected function _initAppAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'App',
            'basePath'  => dirname(__FILE__),
        ));
	
        return $autoloader;

    }



 protected function _initAutoloader() {
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance ();
		$loader->setFallbackAutoloader ( true );
	 }




	protected function _initConfig()
	{
		$config = new Zend_Config($this->getOptions());
		Zend_Registry::set('config', $config);
	}	



	protected function _initModules()
	{
	
		$frontController = Zend_Controller_Front::getInstance();
		$restRoute = new Zend_Rest_Route($frontController);
		$url=$_SERVER['REQUEST_URI'];
		if (stripos($url, "mobileapi") > -1)
		{
			$frontController->getRouter()->addRoute('default', $restRoute);
		}
		
	}	
	
}

