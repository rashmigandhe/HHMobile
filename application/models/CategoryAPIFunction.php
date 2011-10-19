<?php
class App_Model_CategoryAPIFunction
{

	/**
	 *
	 * getCategory is Used to Display the list of Categories
	 *
	 */

	 /** @var obj_user
	 * $obj_user = array() returns
	 */

	public function getCategory($data)
	  {
		$obj_user=array();
		$obj_chkapi = new App_Model_Chkapi();
		$validation_result = $obj_chkapi->chkAPI($data);
		$obj_create = new App_Model_Objcreation();
	
		if(!isset($data['PageNumber']))
		  {
			  $data['PageNumber']=1;
		  }

		  if(!isset($data['RecordsPerPage']))
		  {
			  $data['RecordsPerPage']=3;
		  }
	
		if($validation_result==1)
			{
			  try
				{
						$obj = new App_Model_Category();
						$query= $obj->getCategoryModule($data);
						$obj_pagination_block = new App_Model_PaginationBlock();
						$obj_user= $obj_pagination_block->getPaginationReturnModule($query, $data['RecordsPerPage'], $data['PageNumber'], 'category', '');
				}
				catch(exception $e)
				{
					$obj_user=$obj_create->createObjfalse(3);
				}
			}//end of if($validation_result==1)
			else
			{
				$obj_user=$obj_create->createObjfalse(2);
			}

	    return $obj_user;
    }//end of protected function getCategory($data)

}//end of class App_Model_CategoryAPIFunction
?>