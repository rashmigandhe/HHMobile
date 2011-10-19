<?php
class App_Model_BusinessAPIFunction
{

	/**
	 *
	 * getUserFavoritesBusinesses is Used to Display the list of Users Favorites Businesses
	 *
	 */

	/** @var flag
	 * protected $flag=business 
	 * Passed to createObj method
	 */	

	 /** @var obj_user
	 * $obj_user = array()
	 */
	  public function getUserFavoritesBusinesses($data)	
		  {
		    $obj_user=array();
			$obj_chkapi = new App_Model_Chkapi();
			$validation_result = $obj_chkapi->chkAPI($data);
			$obj_create = new App_Model_Objcreation();
			$flag='business';
			if($validation_result==1)
			{
				
			  try
				{
					$obj = new App_Model_Business();
					$query= $obj->getUserFavoritesBusinessesModule($data);

					$obj_pagination_block = new App_Model_PaginationBlock();
					$obj_user= $obj_pagination_block->getPaginationReturnModule($query, $data['RecordsPerPage'], $data['PageNumber'], 'business', $flag);
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
	}//end of protected function getUserFavoritesBusinesses($data)

}//end of class App_Model_BusinessAPIFunction
?>