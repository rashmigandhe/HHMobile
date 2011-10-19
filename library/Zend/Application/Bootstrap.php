<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
       ///$this->bootstrap('view');
       // $view = $this->getResource('view');
      //  $view->doctype('XHTML1_STRICT');
		
		//enable class autoloader start
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance ();
		$loader->setFallbackAutoloader ( true );
		//enable class autoloader end
		
		$frontCtrl = Zend_Controller_Front::getInstance ();
		$frontCtrl->throwExceptions(true);
		$frontCtrl->addModuleDirectory ( APPLICATION_PATH . '/modules' );
		
		
		
		//set include path for modules
		set_include_path ( get_include_path () . PATH_SEPARATOR . APPLICATION_PATH . '/modules/' );
		
		
		$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/config.xml', 'production');
  	
		
		
		//set database adaptor  
			$db = Zend_Db::factory ( 'PDO_MYSQL', $config->resources->db->params);
			Zend_Registry::set('db',$db);
			
		//cache setting start
		if($config->configuration->cache){
			$frontend= array('lifetime' => 200,'cache_id_prefix'=>'site_','automatic_seralization' => true);
			$backend= array('cache_dir' => APPLICATION_PATH . '/../cache');
			$cache = Zend_Cache::factory('Page','File',$frontend,$backend);
			Zend_Registry::set('cache',$cache);
			$cache->start(md5($_SERVER['REQUEST_URI']));
		}
		
		$theme = 'default';
        if (isset($config->configuration->theme)) {
            $theme = $config->configuration->theme;
        }
		//theme layout path
        $layoutPath = APPLICATION_PATH.'/../public/themes/'.$theme.'/templates';
		
		//get module name
		$arrUrl = array_filter(explode("/",str_replace($config->configuration->base_path, '', $_SERVER['REQUEST_URI'])));
	   $moduleName = current($arrUrl);
	   $modules = array_keys($frontCtrl->getControllerDirectory());
	   $moduleName = in_array($moduleName,$modules)?$moduleName:'default';
	  
		
        $layout = Zend_Layout::startMvc()
            ->setLayout('layout')
            ->setLayoutPath($layoutPath)
            ->setContentKey('content');

      //set view render
	   $view = new Zend_View();
       $view->addBasePath($layoutPath . "/".$moduleName);
       $view->addScriptPath($layoutPath . "/".$moduleName);
	   $view->doctype('XHTML1_STRICT');
	   // Add it to the ViewRenderer
       $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
       $viewRenderer->setView($view);
	 
	   
	 }
}

