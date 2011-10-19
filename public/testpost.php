<?php
//set_time_limit(120) ;
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
//$post_field_str= "Format=json&API=GetDeals&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&CategoryID=1&DealTypeID=-1&PageNumber=1&RecordsPerPage=10&BusinessID=-1";
//&UserID=142&SessionID=61jha6kqtvs2b7hruu5nkboif3
//Latitude=35.782902&Longitude=-78.6472081&



#-- for get deal details
$post_field_str= "format=json&API=GetDealDetails&UserAgent=Android&UserDetail=google_sdk&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&BusinessID=804";
//&UserID=130&SessionID=4o3la11nvlnp2hc1v6c3r49ne7
//[API=GetDealDetails, Format=json, UserAgent=Android, UserDetail=google_sdk, APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417, BusinessID=1464]


#-- for mark as favourite deal
//$post_field_str= "format=json&API=MarkAsFavourite&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=130&BusinessID=804&SessionID=4o3la11nvlnp2hc1v6c3r49ne7";
//OR DealID=14  BusinessID=804

#-- For Get User Favourite Deals 
//$post_field_str= "format=json&API=GetUserFavouriteDeals&UserAgent=web&UserDetail=fabc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=130&PageNumber=2&RecordsPerPage=3&SessionID=4o3la11nvlnp2hc1v6c3r49ne7";


#-- For Get User Favourite Businesses 
//$post_field_str= "format=json&API=GetUserFavoritesBusinesses&UserAgent=web&UserDetail=abc&APIKey=4d8d0522-a76b-46a3-8be6-14d0fd509417&UserID=130&PageNumber=1&RecordsPerPage=2&SessionID=4o3la11nvlnp2hc1v6c3r49ne7";

$url="http://192.168.91.108/hurryhurry/public/mobileapi/";

//$url="http://localhost/ZendRest/public/mobileapi/";
function do_post_request($url, $data, $optional_headers = null)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => $data
            ));
  if ($optional_headers !== null) {
    $params['http']['header'] = $optional_headers;
  }
  $ctx = stream_context_create($params);
  $fp = @fopen($url, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with $url, $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from $url, $php_errormsg");
  }
  return $response;
}

	$buffer = do_post_request($url,$post_field_str, '');
		
		print_r($buffer);

	

?>
