<?php
class App_Model_Subcategory extends Zend_Db_Table 
{
	protected $_name = "location_taggings";

public function getSubCategoryModule($id, $deal_id)
	{
		try
			{
				$db = Zend_Db_Table::getDefaultAdapter();
				$query=  $db->select()
				->from(array('loc_taggings' => $this->_name, array('location_tag_id')));
				$query->where($this->getAdapter()->quoteInto('loc_taggings.deal_id  = ?', $deal_id));	
		

			}
			catch(exception $e)
			{
				$query="error";
			}
	
		return $query;

	}//end of  public function getSubCategoryModule()

}//end of class App_Model_Subcategory