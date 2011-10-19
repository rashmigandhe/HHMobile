<?php
class App_Model_ConnectAPIFunction
{

	/**
	 * System Connect
	 */
		public function systemConnect($data){
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			if($validation_result==1)
			{

				 try
					{
						$obj = new App_Model_Connect();
						$result= $obj->systemConnectModel($data);
					
						if($result)
						{
							
							$obj_user->success = "true";
							$obj_user->systemconnect = new stdClass();
							$obj_user->systemconnect->sessionid = $result; 
						
						}//edn of if($result!=0)
						else
						{
							$obj_user->success = "false";
							$obj_user->Message = "Error1";
						}//end of else
					}//end of try
					catch(exception $e)
					{
						$obj_user->success = "false";
						$obj_user->message = "Error:".$e->getMessage();
					}//end of try

				}
				else
				{
					$obj_user->success = "false";
					$obj_user->message = "Access Denied";
				}
		return $obj_user;
		}//end of public function addUser

}//end of class App_Model_ConnectAPIFunction
?>