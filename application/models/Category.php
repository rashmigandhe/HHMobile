<?php
class App_Model_Category extends Zend_Db_Table 
{
	protected $_name = "business_categories";

public function getCategoryModule($data)
	{
			try
			{
				$db = Zend_Db_Table::getDefaultAdapter();
				$query=  $db->select()
				->from(array('buss_cat' => $this->_name, array('id', 'name', 'default_image_path')));
			}
			catch(exception $e)
			{
				$query="error";
			}
		
		return $query;

	}//end of  public function getCategoryModule()

}//end of class App_Model_Category