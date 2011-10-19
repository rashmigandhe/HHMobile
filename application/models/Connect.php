<?php
class App_Model_Connect extends Zend_Db_Table 
{
	protected $mysession;
	public function systemConnectModel($data)
	{

		
		try
		{
			$session_val = session_id();
			session_start();
		
			if(isset($_SESSION['http_session']))
			{
				echo "in if set";
			}
			else
			{
				$_SESSION['http_session']=$session_val;
			
			}
		

			 $http_session_val =$_SESSION['http_session'];

		}
		catch(exception $e)
		{
		
			print_r($e->getMessage());
		}
		return $http_session_val;
	}//end of  public function systemConnectModel()





public function chkSessionModule($user_id, $sesson_id)
	{
				$this->_name = "user_signin_session";
		$select_session_row  = $this->select()->where('user_id = ?', $user_id)
		->where('session_id = ?', $sesson_id);
		$chk_row = $this->fetchRow($select_session_row);
		if($chk_row)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}





}//end of class App_Model_Connect