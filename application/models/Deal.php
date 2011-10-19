<?php
class App_Model_Deal extends Zend_Db_Table 
{
	protected $_name = "deals";
	protected $_business_locations = "business_locations";
	protected $_businesses = "businesses";
	protected $_business_categories = "business_categories";
	protected $_deal_followers = "deal_followers";
	protected $_business_followers = "business_followers";
	protected $_location_tags = "location_tags";
	protected $query;

public function listDealModule($data)
	{
		if(isset($data['UserID']))
		{
			#-- chk for session in table user_session_id 
			$connect_obj = 	new App_Model_Connect();
			$chk_session=  $connect_obj->chkSessionModule($data['UserID'], $data['SessionID']);
		}
		else
		{
			$chk_session=1;
		}

			if($chk_session)
			{
				
			#-- fecth list of Deals
			try
			{
				$db = Zend_Db_Table::getDefaultAdapter();
				$query=  $db->select()
				->from(array('del' => $this->_name, array('id','description', 'tiny_description', 'type')))
				->join(array('buss_loc' => $this->_business_locations),
				'del.business_id = buss_loc.business_id', array('latitude', 'longitude', 'address'))
				->join(array('buss' => $this->_businesses),
				'buss.id = buss_loc.business_id', array("buss_id"=>'id',"buss_name"=>'name'))
				->join(array('buss_cat' => $this->_business_categories),
				'buss.category_id = buss_cat.id', array('name', "buss_cat_id"=>'id'));



			
				if($data['DealTypeID']!='-1')
				{
					//value for DealTypeID as -1/HurryBackReward/HurryUpDeal/HurryInSpecial
					$query->where($this->getAdapter()->quoteInto('del.type  = ?', $data['DealTypeID']));
				}

				if(isset($data['Latitude']))
				{
					$query->where($this->getAdapter()->quoteInto('buss_loc.latitude  = ?', $data['Latitude']));
				}

				if(isset($data['Longitude']))
				{
					$query->where($this->getAdapter()->quoteInto('buss_loc.longitude  = ?', $data['Longitude']));
				}

				if($data['BusinessID']!='-1')
				{
					$query->where($this->getAdapter()->quoteInto('del.business_id  = ?', $data['BusinessID']));
				}

				if($data['CategoryID']!='-1')
				{
					$query->where($this->getAdapter()->quoteInto('buss.category_id  = ?', $data['CategoryID']));
				}

				if(isset($data['UserID']))
				{
					$query->where($this->getAdapter()->quoteInto('buss.user_id  = ?', $data['UserID']));
				}
				$query->order("del.tiny_description");

			}
			catch(exception $e)
			{
				$query="error";
			}
		}//end of if($chk_session)
		else
		{
			$query="invalid";
		}
		return $query;
	
	}//end of  public function listDealModule()


	


public function detailDealModule($data)
	{

	if(isset($data['UserID']))
		{
			#-- chk for session in table user_session_id 
			$connect_obj = 	new App_Model_Connect();
			$chk_session=  $connect_obj->chkSessionModule($data['UserID'], $data['SessionID']);
		}
		else
		{
			$chk_session=1;
		}

			if($chk_session)
			{
				
				#-- fecth list of Deals
				try
				{
					$db = Zend_Db_Table::getDefaultAdapter();
					$query=  $db->select()
					->from(array('del' => $this->_name, array('id', 'description', 'tiny_description')))
					->join(array('buss_loc' => $this->_business_locations),
					'del.business_id = buss_loc.business_id', array('latitude', 'longitude', 'address'))
					->join(array('buss' => $this->_businesses),
					'buss.id = buss_loc.business_id', array('facebook_url', 'home_page', 'image', 'twitter_handle', "buss_id"=>'id',"buss_name"=>'name', "buss_desc"=>'description',"buss_contact_no"=>'contact_number',"buss_tiny_desc"=>'tiny_description',"buss_email"=>'email', "user_id"=>'user_id'))
					->join(array('buss_cat' => $this->_business_categories),
					'buss.category_id = buss_cat.id',  array('name', "buss_cat_id"=>'id'));

					if(isset($data['DealID']))
					{	
					
						$query->where($this->getAdapter()->quoteInto('del.id  = ?', $data['DealID']));
					}


					if(isset($data['BusinessID']))
					{	
						
						$query->where($this->getAdapter()->quoteInto('del.business_id  = ?', $data['BusinessID']));
					}

					if(isset($data['UserID']))
					{
						$query->where($this->getAdapter()->quoteInto('buss.user_id  = ?', $data['UserID']));
					}
					$query->order("del.tiny_description");
				}
				catch(exception $e)
				{
						$query="error";
				}
			}//end of if($chk_session)
			else
			{
				$query="invalid";
			}
		return $query;

	}//end of public function detDealModule($data)


public function markAsFavouriteDealModule($data)
	{
		$result="";

		#-- chk for session in table user_session_id 
		$connect_obj = 	new App_Model_Connect();
		$chk_session=  $connect_obj->chkSessionModule($data['UserID'], $data['SessionID']);
			
		if($chk_session)
		{
		
			#-- fecth list of Deals
			try
			{
				$current_date = date("Y-m-d");
				if(isset($data['BusinessID']))
				{
					$this->_name = "business_followers";
					$this->_column_name_id = "business_id";
					$chk_id = $data['BusinessID'];
				}

				if(isset($data['DealID']))
				{
					$this->_name = "deal_followers";
					$this->_column_name_id = "deal_id";
					$chk_id = $data['DealID'];
				}

						
				$select  = $this->select()->where('user_id = ?', $data['UserID'])
				->where($this->_column_name_id. '= ?', $chk_id);

				$dup_out = $this->fetchRow($select);

				if($dup_out)
				{
						$where = $this->getAdapter()->quoteInto('user_id = ?', $data['UserID']);
						$where = $this->getAdapter()->quoteInto($this->_column_name_id.'= ?', $chk_id);
						$val = $this->delete($where);
						$result='unset';
				}
				else
				{
						$follower_id= $this->insert(array("user_id"=>$data['UserID'], $this->_column_name_id => $chk_id, "created_at"=>$current_date,  "updated_at"=>$current_date));
						$result='set';
				}
			}
			catch(exception $e)
			{
		
				$result="error";
			}
		}
		else
		{
			$result=2;
		}

		return $result;

	}//end of public function markAsFavouriteDealModule($data)


public function getUserFavouriteDealsModule($data)
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
					->from(array('del_foll' => $this->_deal_followers, array('id', 'deal_id', 'user_id')))
					->join(array('del' => $this->_name),
					'del.id = del_foll.deal_id', array('id', 'description', 'tiny_description'))
					->join(array('buss_loc' => $this->_business_locations),
					'del.business_id = buss_loc.business_id', array('latitude', 'longitude', 'address'))
					->join(array('buss' => $this->_businesses),
					'buss.id = buss_loc.business_id', array('image'))

					->join(array('buss_cat' => $this->_business_categories),
					'buss.category_id = buss_cat.id',  array('name', "buss_cat_id"=>'id'));	
				

					if($data['UserID'])
					{
						$query->where($this->getAdapter()->quoteInto('del_foll.user_id  = ?', $data['UserID']));
					}
				}
				catch(exception $e)
				{
				
					$query="error";
				}
			}
		else
		{
			$query="invalid";
		}
		return $query;
	}//end of  public function getUserFavouriteDealsModule()


public function checkFavouriteDealBusinesssModule($user_id=null, $id, $flag)
	{
	
			if($user_id)
				{
							if($flag=='business')
							{
							$this->_name = "business_followers";
							$this->_column_name_id = "business_id";

							}

							if($flag=='deal')
							{
							$this->_name = "deal_followers";
							$this->_column_name_id = "deal_id";
							}

						$select  = $this->select()->where('user_id = ?', $user_id)
						->where($this->_column_name_id. '= ?', $id);
					$dup_out = $this->fetchRow($select);
					if($dup_out)
						{
							return true;
						}
					else
						{
							return false;
						}
				}
			else
				{
					return false;
				}
	}//end of public function checkFavouriteDealsModule($user_id, $id, $flag)


}//end of class App_Model_Deal