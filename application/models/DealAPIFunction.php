<?php
class App_Model_DealAPIFunction
{

	/**
	 *
	 * Used to Display the list of Deals as per the search string
	 *
	 */
	 
	/** @var flag
	 * protected $flag=deal 
	 * Passed to createObj method
	 */

	/** @var obj_user
	 * $obj_user = array()
	 */
	public function listDeal($data)
		{
			$obj_user=array();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			$obj_create = new App_Model_Objcreation();
			if($validation_result==1)
			{
			   $flag="deal";
			   try
				{
					$obj = new App_Model_Deal();
					$query= $obj->listDealModule($data);
					
					$obj_pagination_block = new App_Model_PaginationBlock();
					$obj_user= $obj_pagination_block->getPaginationReturnModule($query, $data['RecordsPerPage'], $data['PageNumber'], 'deal', $flag);

				 }
				 catch(exception $e)
				 {
					$msg= $e->getMessage();
					$obj_user=$obj_create->createObjfalse(3, $msg);
				 }
				}
				else
				{
					$obj_user=$obj_create->createObjfalse(2);
				}

		return $obj_user;
	}//end of function listDeals()
	


	/**
	 *
	 * Used to Display the Details of the Deals
	 *
	 */
	 
	/** @var flag
	 * protected $flag=deal 
	 * Passed to createObj method
	 */

	/** @var obj_user
	 * $obj_user = array()
	 */
	public function detailDeals($data)	{
			$obj_user = array();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			$obj_create = new App_Model_Objcreation();
			if($validation_result==1)
			{
				$flag="deal";

			  try
				{
					$obj = new App_Model_Deal();
					$query= $obj->detailDealModule($data);
				
					$obj_pagination_block = new App_Model_PaginationBlock();
					$obj_user= $obj_pagination_block->getPaginationReturnModule($query, 1, 1, 'dealdet', $flag);
					
				}//end of try
				catch(exception $e)
				{
					$msg= $e->getMessage();
					$obj_user=$obj_create->createObjfalse(3, $msg);
				}//end of catch
			}//end of if($validation_result==1)
			else
			{
				$obj_user=$obj_create->createObjfalse(2);
			}//end of else if($validation_result==1)

		return $obj_user;
	}//end of function detDeals()



	/**
	 *
	 *  Get list of User Favourite Deals
	 *
	 */
	 
	/** @var flag
	 * protected $flag=deal 
	 * Passed to createObj method
	 */

	/** @var obj_user
	 * $obj_user = array()
	 */
	
	  public function getUserFavouriteDeals($data)	{
		    $obj_user = array();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			$obj_create = new App_Model_Objcreation();
			$flag='deal';
			if($validation_result==1)
			{
			  try
				{
					$obj = new App_Model_Deal();
					$query = $obj->getUserFavouriteDealsModule($data);
					
					$obj_pagination_block = new App_Model_PaginationBlock();
					$obj_user= $obj_pagination_block->getPaginationReturnModule($query, $data['RecordsPerPage'], $data['PageNumber'], 'deal', $flag);

				}//end of try
				catch(exception $e)
				{
					$obj_user=$obj_create->createObjfalse(3);
				}//end of catch
			}//end of if($validation_result==1)
			else
			{
				$obj_user=$obj_create->createObjfalse(2);
			}//end of else if($validation_result==1)

		return $obj_user;
	}//end of protected function getUserFavouriteDeals($data)




	/**
	 *
	 *  Mark As Favourite Deal or Business
	 *
	 */

	/** @var obj_user
	 * $obj_user = array()
	 */
	
	  public function makAsFavourite($data) {
 		    $obj_user = array();
			$obj_create = new App_Model_Objcreation();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			if($validation_result==1)
			{
				 try
					{
						$obj = new App_Model_Deal();
						$result= $obj->markAsFavouriteDealModule($data);
				
						if($result=="set" || $result=="unset")
						{
							$obj_user = $obj_create->createObjFavourite($data, $result);
						}
						elseif($result=="2")
						{
							$obj_user=$obj_create->createObjfalse(4);
						}
						else
						{
							$obj_user=$obj_create->createObjfalse(0);
						}
					}
					catch(exception $e)
					{
						$obj_user=$obj_create->createObjfalse(3);
					}
			}
			else
			{
					$obj_user=$obj_create->createObjfalse(2);
			}

			return $obj_user;
	   }//end of public function makAsFavourite($data)

}//end of class App_Model_Function_DealAPIFunction
?>