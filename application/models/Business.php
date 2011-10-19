<?php
class App_Model_Business extends Zend_Db_Table 
{
	protected $_name = "deals";
	protected $_business_locations = "business_locations";
	protected $_businesses = "businesses";
	protected $_business_categories = "business_categories";
	protected $_deal_followers = "deal_followers";
	protected $_business_followers = "business_followers";
	protected $query;

public function getUserFavoritesBusinessesModule($data)
	{

		#-- chk for session in table user_session_id 
		$connect_obj = 	new App_Model_Connect();
		$chk_session=  $connect_obj->chkSessionModule($data['UserID'], $data['SessionID']);
			
		if($chk_session)
		{

			try
			{
				$db = Zend_Db_Table::getDefaultAdapter();
				$query=  $db->select()
				->from(array('buss_foll' => $this->_business_followers, array('business_id', 'user_id')))
				->join(array('buss' => $this->_businesses),
				'buss.id = buss_foll.business_id', array('description', 'tiny_description','image'))
				->join(array('buss_loc' => $this->_business_locations),
				'buss.id = buss_loc.business_id', array('latitude', 'longitude', 'address'))

				->join(array('buss_cat' => $this->_business_categories),
					'buss.category_id = buss_cat.id',  array('name', "buss_cat_id"=>'id'));	
				
				if($data['UserID'])
				{
					$query->where($this->getAdapter()->quoteInto('buss_foll.user_id  = ?', $data['UserID']));
				}
			}
			catch(exception $e)
			{
				echo "Error: ".$e->getMessage();
			}
		}

		else
		{
			$query="invalid";
		}
		return $query;

	
	}//end of  public function getUserFavouriteDealsModule()

}//end of class App_Model_Business