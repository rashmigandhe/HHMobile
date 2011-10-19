<?php
class App_Model_DecideAction 
{

	/**
	 *
	 * Used to Descide action as the the API Call from outside.
	 *and it gives call to the corresponding modules.
	 *
	 */
	
	/**
	 * @var data
	 * protected $data =array();
	 */

	public function decideAPICall($functionName, $params)
	{
		$data = array();

		switch($functionName)
		{
			case 'SystemConnect':
				$obj_connectapifunction = new App_Model_ConnectAPIFunction();
				$data = $obj_connectapifunction->systemConnect($params);
				break;

			case 'SignIn':
				$obj_userapifunction = new App_Model_UserAPIFunction();
				$data = $obj_userapifunction->addUser($params);
				break;

			case 'UpdateAccount':
				$obj_userapifunction = new App_Model_UserAPIFunction();
				$data = $obj_userapifunction->updateUser($params);
				break;

			case 'SignOut':
				$obj_userapifunction = new App_Model_UserAPIFunction();
				$data = $obj_userapifunction->signoutUser($params);
				break;

			case 'GetDeals':
				$obj_dealapifunction = new App_Model_DealAPIFunction();
				$data = $obj_dealapifunction->listDeal($params);
				break;

			case 'GetDealDetails':
				$obj_dealapifunction = new App_Model_DealAPIFunction();
				$data = $obj_dealapifunction->detailDeals($params);
				break;

			case 'MarkAsFavourite':
				$obj_dealapifunction = new App_Model_DealAPIFunction();
				$data = $obj_dealapifunction->makAsFavourite($params);
				break;

			case 'GetUserFavouriteDeals':
				$obj_dealapifunction = new App_Model_DealAPIFunction();
				$data = $obj_dealapifunction->getUserFavouriteDeals($params);
				break;

			case 'GetUserFavoritesBusinesses':
				$obj_businessapifunction = new App_Model_BusinessAPIFunction();
				$data = $obj_businessapifunction->getUserFavoritesBusinesses($params);
				break;
				
			case 'GetCategories':
				$obj_categoryapifunction = new App_Model_CategoryAPIFunction();
				$data = $obj_categoryapifunction->getCategory($params);
				break;

			case 'GetSubCategories':
				$obj_categoryapifunction = new App_Model_SubCategoryAPIFunction();
				$data1 = $obj_categoryapifunction->getSubCategory($params, '');

				if(sizeof($data1)==2)
				{
					$data = $data1[0];
				}
				else
				{
					$data = $data1;
				}
				break;



			default:
				$data=array("No API called");
		}

			
		return $data;

	}//end of decideAPICall

}//end of class App_Model_Decideaction