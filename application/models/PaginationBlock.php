<?php
class App_Model_PaginationBlock
{
	#-- This function is used for pagination code to discide no of records to be displayed per page.
	public function getPaginationReturnModule($query, $recordsperpage=10, $pagenumber=1, $api=null, $flag=null)
	  {
		//echo "<b>api=$api</b><br>";
		
		$obj_user=array();
		$obj_create = new App_Model_Objcreation();
		
		if($query=="error")
			{
				$obj_user=$obj_create->createObjfalse(3);
			}

		else if($query=="invalid")
			{
				$obj_user=$obj_create->createObjfalse(4);
			}
			else
			{
				$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($query));
				$paginator->setItemCountPerPage($recordsperpage)
				->setCurrentPageNumber($pagenumber);

				if($paginator->getTotalItemCount())
				{
					if($api=="category")
					{

						$obj_user=$obj_create->createObjCategory($paginator);
					}
					else if($api=="subcategory")
					{
						$obj_user=$obj_create->createObjSubCategory($paginator);
					}

					else if($api=="dealdet")
					{
						$obj_user=$obj_create->createObjDealDetail($paginator, $flag);
					}
					else
					{
						$obj_user=$obj_create->createObj($paginator, $flag);
					}
				}
				else
				{
					$obj_user=$obj_create->createObjfalse(1);
				}
			}//end of else of if($category_result=="error")
	    return $obj_user;
    }//end of protected function getPaginationReturnModule($data)

}//end of class App_Model_PaginationBlock


	?>
