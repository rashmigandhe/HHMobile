<?php
set_time_limit(120) ;
#-- For System Connect
//$post_field_str= "format=json&API=SystemConnect&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&Latitude=100.000&Longitude=60.00";


#-- For add user (Sign In)
//$post_field_str= "format=json&API=SignIn&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UniqueID=5121234343&Email=agandhe@www.com&BirthDate=1981-04-06&Location=Nagpur&Gender=Female&OauthToken=123&Provider=Facebook&ProfileImageURL=http://www.google.com";

//$post_field_str= "API=SignIn&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&BirthDate=1981-06-04&Email=agandhe@www.com&Format=json&Gender=Female&Location=Nagpur&OauthToken=12221131313131313&ProfileImageURL=''&Provider=Facebook&UniqueID=121234343&UserAgent=iPhone&UserDetail=iPhone 4- Carrier Verizon";






#-- For UpdateAccount
//$post_field_str= "format=json&API=UpdateAccount&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UniqueID=25121234343&UserID=136&Email=agandhe@www.com&BirthDate=1981-04-06&Location=Nagpur&Gender=Female&OauthToken=123&Provider=Facebook&ProfileImageURL=http://www.google123456.com&SessionID=sdnbha9dh2orbe20q33p4848g5";


#-- for user Sign Out
//$post_field_str= "format=json&API=SignOut&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=136&SessionID=sdnbha9dh2orbe20q33p4848g5";


#-- for List OF categories
//$post_field_str= "format=json&API=GetCategories&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&RecordsPerPage=2&PageNumber=1";

#-- for List OF SubCategories
//$post_field_str= "format=json&API=GetSubCategories&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&RecordsPerPage=100&PageNumber=1&CategoryID=4";
//



#-- For  get List of deals
//$post_field_str= "Format=json&API=GetDeals&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&CategoryID=1&DealTypeID=-1&PageNumber=1&RecordsPerPage=5&BusinessID=-1";
//&UserID=142&SessionID=61jha6kqtvs2b7hruu5nkboif3
//Latitude=35.782902&Longitude=-78.6472081&

#-- For  get List of deals
//$post_field_str= "Format=json&API=GetDeals&UserAgent=Android&UserDetail=google_sdk&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&CategoryID=1&DealTypeID=-1&PageNumber=2&RecordsPerPage=25&BusinessID=-1";
//&UserID=142&SessionID=61jha6kqtvs2b7hruu5nkboif3
//Latitude=35.782902&Longitude=-78.6472081&


#-- for get deal details
//$post_field_str= "format=json&API=GetDealDetails&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&DealID=15";
//&UserID=130&SessionID=4o3la11nvlnp2hc1v6c3r49ne7



#-- for mark as favourite deal
//$post_field_str= "format=json&API=MarkAsFavourite&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=130&DealID=1880&SessionID=4o3la11nvlnp2hc1v6c3r49ne7";
//OR DealID=14  BusinessID=804

#-- For Get User Favourite Deals 
//$post_field_str= "format=json&API=GetUserFavouriteDeals&UserAgent=web&UserDetail=fabc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=139&PageNumber=1&RecordsPerPage=3&SessionID=n23dstkcnk2ecdrbrqfmuqakk6";


#-- For Get User Favourite Businesses 
$post_field_str= "format=json&API=GetUserFavoritesBusinesses&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=130&PageNumber=1&RecordsPerPage=10&SessionID=4o3la11nvlnp2hc1v6c3r49ne7";




		$curl_handle=curl_init();
		//curl_setopt($curl_handle,CURLOPT_URL,'http://localhost/Sirka/public/mobileapi/');
		//curl_setopt($curl_handle,CURLOPT_URL,'http://192.168.91.108/mobileapi/');
		curl_setopt($curl_handle,CURLOPT_URL,'http://192.168.91.108/hurryhurry/public/mobileapi/');
	//	curl_setopt($curl_handle,CURLOPT_URL,'http://localhost/ZendRest/public/mobileapi/');
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl_handle, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($curl_handle, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,120);
		curl_setopt($curl_handle, CURLOPT_POST, TRUE);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $post_field_str);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, 120);
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		
		print_r($buffer);

		$json_to_arr = json_decode($buffer);
	//	print_r($json_to_arr);


			/*	echo "<br><br><br>after obj var<br><br><br><br><br><br>";
		$result_arr = get_object_vars($json_to_arr);
		$deals = $result_arr['Deals'];
		
		//print_r($deals);

		$deals_arr = get_object_vars($deals);
		
		$records_arr = $deals_arr['record'];
			$AllTagArr = $result_arr['AllTagArr'];

			print_r($AllTagArr);
			echo "<br>";

			for($i=0; $i < sizeof($AllTagArr); $i++)
			{
					echo $AllTagArr[$i]."<br>";

			}
			
			for($i=0;$i<sizeof($records_arr); $i++)
			{
					$records_data = get_object_vars($records_arr[$i]);
					//print_r($records_data);
					echo "<br><br><br>";
					echo "dealid id:=".$records_data['dealid']."&nbsp;Title:".$records_data['title'] ;
					echo "<br>";
			}
*/

?>
