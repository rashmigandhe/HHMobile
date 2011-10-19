<?php

class MobileapiController extends My_Rest_Controller
{

	public function getAction()
	{
		#--do nothing
	}

	/**
	 *
	 * postAction method is used to get the API Call details and 
	 * to give corresponding response
	 *
	 */
	public function postAction()
		{
	
			$functionName = $this->_getParam('API');
			$params = $this->_request->getParams();
		
			$obj_decideaction = new App_Model_DecideAction();
			if($functionName)
			{
				$data = $obj_decideaction->decideAPICall($functionName, $params);
			}
			
			if(isset($data))
			{
				$this->sendResponse($data);
			}
			else
			{
				$error->success = "false";
				$error->message = "Error";
				$this->sendResponse($error);
			}
	 }//end of postAction
}//end of class