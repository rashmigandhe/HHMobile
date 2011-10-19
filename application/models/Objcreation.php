<?php
class App_Model_Objcreation
{
	public function createObj($paginator, $flag)
	{
			$tag_arr=array();
			$all_tags_arr=array();
			$sub_cat_data="";
		
			$all_tags_str="";
			$obj_user->success = "true";
			$user_id=0;
			if($flag=="deal")
			{
 			 $obj_user->Deals = new stdClass();
			}
			if($flag=="business")
			{
 			 $obj_user->Businesses = new stdClass();
			}
			$arr=array();
			foreach($paginator as $item)
			{
				

				$obj_deal = new App_Model_Deal();
				$obj_name = 'object';
				$obj_name = new stdClass();  

				if(isset($item['user_id']))
					{
						$user_id=$item['user_id'];
					}

				if(isset($item['id']) && $flag=="deal")
				{
					$obj_name->deal_id = $item['id']; 
					
				
				}

				if(isset($item['type']))
				{
					$obj_name->deal_type = $item['type']; 
				}
				if(isset($item['business_id']) && $flag=="business")
				{
					$obj_name->business_id = $item['business_id']; 
					
				}
				if(isset($item['id']))
				{
				$mark_as_fav_status_deal = $obj_deal->checkFavouriteDealBusinesssModule($user_id, $item['id'], 'deal');
				}
				$obj_name->favourite_flag_deal = $mark_as_fav_status_deal; 
				if(isset($item['business_id']))
				{
					$mark_as_fav_status_business = $obj_deal->checkFavouriteDealBusinesssModule($user_id, $item['business_id'], 'business');
					$obj_name->favourite_flag_business = $mark_as_fav_status_business; 
				}
				$obj_name->title = $item['tiny_description']; 
				$obj_name->latitude = $item['latitude']; 
				$obj_name->longitude = $item['longitude']; 
				$obj_name->address = $item['address']; 
				$obj_name->description = $item['description']; 
				
			

				if(isset($item['user_id']))
				{
					$obj_name->user_id = $item['user_id']; 
				}
					
		
		
			
				if(isset($item['buss_cat_id']))
				{
					$obj_name->category_id = $item['buss_cat_id']; 
					$obj_subcategoryapifunction = new App_Model_SubCategoryAPIFunction();
					$sub_cat_data = $obj_subcategoryapifunction->getSubCategory($item['buss_cat_id'], $item['id']);
				}	
			

				if(isset($item['buss_id']))
				{
					$obj_name->business_id = $item['buss_id']; 
				}

				if(isset($item['buss_name']))
				{
					$obj_name->business_name = $item['buss_name']; 
				}

	
				if(isset($sub_cat_data))
				{
					if(sizeof($sub_cat_data)>1)
					{
						$obj_name->tags = $sub_cat_data[1]; 
					}
				}

			   if(sizeof($sub_cat_data)>1)
				{
						$all_tags_str.=$sub_cat_data[2];

				}

			array_push($arr, $obj_name);	
				
			}//end of for

			if($flag=="deal")
			{
				$obj_user->Deals->record = $arr;
			}

		

			if($flag=="business")
			{
				$obj_user->Businesses->record = $arr;
			}

			$total_records_count=$paginator->getTotalItemCount();
			$obj_user->totalrecord = $total_records_count;

			if(isset($sub_cat_data))
				{
					$all_tags_arr = explode("|", $all_tags_str);
					array_pop($all_tags_arr);	
					$all_tags_arr_unique = array_unique($all_tags_arr);
					$obj_user->AllTagArr = $all_tags_arr_unique; 
				}

		return $obj_user;

	}//end of createObj





public function createObjDealDetail($paginator, $flag)
	{
			$tag_arr=array();
			$all_tags_arr=array();
			$sub_cat_data="";

			$all_tags_str="";
			$obj_user->success = "true";
			if($flag=="deal")
			{
 			 $obj_user->Deals = new stdClass();
			}
			if($flag=="business")
			{
 			 $obj_user->Businesses = new stdClass();
			}
			$arr=array();
			foreach($paginator as $item)
			{
				$obj_name = 'object';
				$obj_name = new stdClass();  
				if(isset($item['id']) && $flag=="deal")
				{
					$obj_name->deal_id = $item['id']; 
				}

				if(isset($item['type']))
				{
					$obj_name->deal_type = $item['type']; 
				}
				if(isset($item['business_id']) && $flag=="business")
				{
					$obj_name->business_id = $item['business_id']; 
				}


				$obj_name->title = $item['tiny_description']; 
				$obj_name->latitude = $item['latitude']; 
				$obj_name->longitude = $item['longitude']; 
				$obj_name->address = $item['address']; 
				$obj_name->description = $item['description']; 
				
				if(isset($item['image']))
				{
					$obj_name->thumbnail = $item['image']; 
				}
				if(isset($item['image']))
				{
				  $obj_name->largeimage = $item['image']; 
				}
				if(isset($item['facebook_url']))
				{
					$obj_name->facebookpage = $item['facebook_url']; 
				}
				if(isset($item['home_page']))
				{
					$obj_name->webURL = $item['home_page']; 
				}
				if(isset($item['twitter_handle']))
				{
					$obj_name->twitterURL = $item['twitter_handle']; 
				}

				if(isset($item['buss_id']))
				{
					$obj_name->business_id = $item['buss_id']; 
				}

				if(isset($item['buss_name']))
				{
					$obj_name->business_name = $item['buss_name']; 
				}

					if(isset($item['buss_contact_no']))
				{
					$obj_name->business_contact_no = $item['buss_contact_no']; 
				}

				if(isset($item['buss_email']))
				{
					$obj_name->business_email = $item['buss_email']; 
				}

				if(isset($item['buss_tiny_desc']))
				{
					$obj_name->business_tiny_desc = $item['buss_tiny_desc']; 
				}

				if(isset($item['buss_desc']))
				{
					$obj_name->business_desc = $item['buss_desc']; 
				}

			if($flag=="deal")
				{
					$obj_user->Deals = $obj_name;
				}

		
				if($flag=="business")
				{
					$obj_user->Businesses = $obj_name;
				}
					
				
			}//end of for

			
		return $obj_user;

	}//end of createObjDealDetail




public function createObjfalse($msg_type, $msg=null)
	{
		if($msg=="")
		{
			$msg="Error";
		}
		$obj_user->success = "false";
		
		switch($msg_type)
		{
		case 1:
			$obj_user->message = "No Results Found";
			break;
		case 2:
			$obj_user->message = "Access Denied";
			break;
		case 3:
			$obj_user->message = $msg;
			break;
		case 4:
			$obj_user->message = "Invalid Session";
			break;

		}//end of switch

		return $obj_user;
	}//end of public function createObjfalse($msg_type, $msg=null)




public function createObjFavourite($data, $result)
	{
				$obj_user->success = "true";
				$obj_user->SetFavourite = new stdClass();
				$arr=array();

				$obj_name = 'object1';
				$obj_name = new stdClass();  
				if(isset($data['BusinessID']))
				{
				$obj_name->business_id = $data['BusinessID']; 
				}
				if(isset($data['DealID']))
				{
				$obj_name->deal_id = $data['DealID']; 
				}

				$obj_name->user_id = $data['UserID']; 
				$obj_name->favorite = $result; 
				array_push($arr, $obj_name);
				$obj_user->SetFavourite = $arr;

		return $obj_user;

}//end of createObjFavourite




public function createObjCategory($paginator)
	{
			$obj_user->success = "true";
			$obj_user->Category = new stdClass();

			$arr=array();
			foreach($paginator as $item)
			{
			$obj_name = 'object';
			$obj_name = new stdClass();  
			$obj_name->id = $item['id']; 
			$obj_name->categoryName = $item['name']; 
			$obj_name->image_path = $item['default_image_path'];
			array_push($arr, $obj_name);
			}
			$obj_user->Category->record = $arr;

			$total_records_count=$paginator->getTotalItemCount();
			$obj_user->totalrecord = $total_records_count;

		return $obj_user;

}//end of createObjCategory




public function createObjSubCategory($paginator)
	{
			
			$response_arr = array();
			$all_tags_arr =array();
			
			$str="";
			$all_tags_str="";
			$obj_user->SubCategory = new stdClass();

			$arr=array();
			foreach($paginator as $item)
			{
			
				$obj_name = 'object';
				$obj_name = new stdClass();  
				if(isset($item['id']))
					{
						$obj_name->id = $item['id']; 
					}
				if(isset($item['name']))
					{
						$obj_name->SubCategoryName = $item['name']; 
					}
					array_push($arr, $obj_name);
					$str.= $item['id']."|";

						$all_tags_str.= $item['id']."|";
									
			}
			$obj_user->SubCategory->record = $arr;

			array_push($response_arr, $obj_user);
			array_push($response_arr, $str);
			array_push($response_arr, $all_tags_str);
			return $response_arr;

}//end of createObjSubCategory






public function createObjUser($data, $result_arr)
	{
		$obj_user = new stdClass();  
		$obj_user->success = "true";
		if(isset($result_arr[0]))
			$obj_user->userid = $result_arr[0]; 
		if(isset($result_arr[1]))
			$obj_user->IsNew = $result_arr[1];

		if(isset($result_arr[2]))
			$obj_user->UsersessionID = $result_arr[2];
			$obj_user->Email =  $result_arr[7];
			$obj_user->Location = $result_arr[5];
			$obj_user->Gender = $result_arr[3];
			$obj_user->ProfileImageURL = $result_arr[6];
			$obj_user->DateOfBirth = $result_arr[4];

		return $obj_user;

}//end of createObjUser


}//end of class