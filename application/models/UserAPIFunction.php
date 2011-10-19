<?php
class App_Model_UserAPIFunction
{

	/**
	 *
	 * Used to Sign In User
	 *
	 */

	/**
	 *
	 * @var obj_user
	 * $obj_user = array()
	 *
	 */
		public function addUser($data){
			$obj_user=array();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			$obj_create = new App_Model_Objcreation();
			if($validation_result==1)
			{

				 try
					{
						$obj = new App_Model_User();
						$result= $obj->addUserModel($data);
						$result_arr = split("~", $result);
						if($result_arr[0]!=0)
							{
								$obj_user=$obj_create->createObjUser($data,$result_arr);
							}//edn of if($result!=0)
							else
							{
								$obj_user=$obj_create->createObjfalse(3);
							}//end of else
					}//end of try
					catch(exception $e)
					{
						$msg= $e->getMessage();
						$obj_user=$obj_create->createObjfalse(3, $msg);
					}//end of try
				}
				else
				{
				  $obj_user=$obj_create->createObjfalse(2);
				}

		return $obj_user;
		}//end of public function addUser
	







/**
	 * Update Users
	 */
		public function updateUser($data){
			$obj_user=array();
			$obj_create = new App_Model_Objcreation();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			if($validation_result==1)
			{

				 try
					{
						$obj = new App_Model_User();
						$result= $obj->updateUserModel($data);

						if($result=="invalid")
						{
							 $obj_user=$obj_create->createObjfalse(4);
						}
						else if($result=="error")
						{
							 $obj_user=$obj_create->createObjfalse(3);
						}
						else
						{
							$result_arr = split("~", $result);
							if($result_arr[0]!=0)
							{
								$obj_user=$obj_create->createObjUser($data,$result_arr);
							}//edn of if($result!=0)
							else
							{
								  $obj_user=$obj_create->createObjfalse(3);
							}//end of else
						}
					}//end of try
					catch(exception $e)
					{
						$msg= $e->getMessage();
						 $obj_user=$obj_create->createObjfalse(3, $msg);
					}//end of try

				}
				else
				{
					  $obj_user=$obj_create->createObjfalse(2);
				}
		return $obj_user;
		}//end of public function updateUser
	


	/**
	 * Sign Out Users
	 */
		public function signoutUser($data){
			$obj_user=array();
			$obj_create = new App_Model_Objcreation();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			if($validation_result==1)
			{

				 try
					{
						$obj = new App_Model_User();
						$result= $obj->SingOutUserModel($data);
				
						if($result)
						{
							$obj_user = new stdClass();  
							$obj_user->success = "true";
							$obj_user->userid =$data['UserID']; 
							$obj_user->SignOut = 1;
							$obj_user->UsersessionID = $data['SessionID'];
						}//edn of if($result!=0)
						else
						{
							$msg =  "User already signed out";
							$obj_user=$obj_create->createObjfalse(3, $msg);
						}//end of else
					}//end of try
					catch(exception $e)
					{
						$msg = $e->getMessage();
					    $obj_user=$obj_create->createObjfalse(3, $msg);
					}//end of try
				}
				else
				{
					$obj_user=$obj_create->createObjfalse(2);
				}
		return $obj_user;
		}//end of public function updateUser
	
}//end of class App_Model_UserAPIFunction
?>