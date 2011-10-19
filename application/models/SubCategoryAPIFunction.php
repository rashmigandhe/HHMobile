<?php
class App_Model_SubCategoryAPIFunction
{

	/**
	 *
	 * getCategory is Used to Display the list of SubCategory
	 *
	 */

	 /** @var obj_user
	 * $obj_user = array() returns
	 */

	public function getSubCategory($id, $deal_id)
	  {

		$obj_user=array();
		$obj_create = new App_Model_Objcreation();
	
			  try
				{
						$obj = new App_Model_Subcategory();
						$query= $obj->getSubCategoryModule($id, $deal_id);
						$obj_pagination_block = new App_Model_PaginationBlock();
						$obj_user= $obj_pagination_block->getPaginationReturnModule($query, '100', 1, 'subcategory', '');
					
				}
				catch(exception $e)
				{
					$obj_user=$obj_create->createObjfalse(3);
				}
		

	    return $obj_user;
    }//end of protected function getSubCategory($data)

}//end of class App_Model_SubCategoryAPIFunction
?>