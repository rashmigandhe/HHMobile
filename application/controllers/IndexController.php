<?php

class IndexController extends Zend_Controller_Action
{
	public function init()
    {

	}


    public function indexAction()
    {
 		$obj1 = new App_Model_Test();
		$res = $obj1->testModule();
		echo "res=$res<br>";
	//$this->view->users_arr=$result;
	
	}//end of     public function indexAction()

    

 public function testAction()
    {
 		
	
	
	}//end of     public function indexAction()

 

}//end of class



