<?php
class App_Model_Chkapi extends Zend_Db_Table 
{
	public function chkAPI($data)
	{
		$config  = Zend_Registry::get('config');
		$this->apikey= $config->validate->API->key;
		if($data['APIKey']==$this->apikey)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}//end of chkAPI

}//end of class