<?php
class App_Model_User extends Zend_Db_Table 
{
	protected $_name = "users";

public function addUserModel($data)
	{
		$is_new="";
		$current_date=date("Y-m-d");
		try
		{

			$this->_name='users';
			$select  = $this->select()->where('email = ?', $data['Email']);
			$dup_out = $this->fetchRow($select);
	
			if($dup_out)
			{
				$user_id =  $dup_out['id'];
				$gender =  $dup_out['gender'];
				$birthDate =  $dup_out['birthDate'];
				$address =  $dup_out['address'];
				$image_url =  $dup_out['image_url'];
				$email =  $dup_out['email'];
				$is_new="0";
			}//end of if if($dup_out)
			else
			{
				#-- chk for Unique ID:
				$this->_name='authentications';
				$select1  = $this->select()->where('provider_uid = ?', $data['UniqueID']);
				$dup_out1 = $this->fetchRow($select1);
				if($dup_out1)
				{
			
					$user_id =  $dup_out1['user_id'];
					$is_new="0";

				}
				else
				{
					$this->_name='users';
					$user_id= $this->insert(array('email'=>$data['Email'], "created_at"=>$current_date, "updated_at"=>$current_date, "image_url"=>$data['ProfileImageURL'],"address"=>$data['Location'],"birthDate"=>$data['BirthDate'], "gender"=>$data['Gender']));
					
					$this->_name='authentications';
					$authentications_id= $this->insert(array('user_id'=>$user_id,"provider"=>$data['Provider'], "provider_uid"=>$data['UniqueID'],"oauth_token"=>$data['OauthToken'], "created_at"=>$current_date, "updated_at"=>$current_date,"active"=>'TRUE'));
					$is_new="1";


					$gender =  $data['Gender'];
					$birthDate =  $data['BirthDate'];
					$address =  $data['Location'];
					$image_url =  $data['ProfileImageURL'];
					$email =  $data['Email'];
				}
			}//end of else	

			
				
					#-- create session and store it in database table user_signin_session
					$this->_name='user_signin_session';
					session_start();
					$session_id = session_id();
			
					$select_session_row  = $this->select()->where('user_id = ?', $user_id);
					$chk_row = $this->fetchRow($select_session_row);
					if($chk_row)
					{
							$session_id =  $chk_row['session_id'];
					}
					else
					{
						$sess_autoid= $this->insert(array('user_id'=>$user_id, "session_id"=>$session_id, "updated_at"=>$current_date));
					}

					
			
			//$str=$user_id."~".$is_new."~".$session_id;
			$str=$user_id."~".$is_new."~".$session_id."~".$gender."~".$birthDate."~".$address."~".$image_url."~".$email;
			
		}
		catch(exception $e)
		{
		
			print_r($e->getMessage());
		
		}
		return $str;
	}//end of  public function addUserModel()





public function updateUserModel($data)
	{
		$is_new="";
		$current_date=date("Y-m-d");

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

			try
			{
				$this->_name='users';
				$select  = $this->select()->where('id = ?', $data['UserID']);
				$dup_out = $this->fetchRow($select);
				if($dup_out)
				{
					$user_id =  $dup_out['id'];
					$gender =  $dup_out['gender'];
					$birthDate =  $dup_out['birthDate'];
					$address =  $dup_out['address'];
					$image_url =  $dup_out['image_url'];
					$email =  $dup_out['email'];
					
					$this->_name='authentications';
					$select1  = $this->select()->where('user_id = ?', $data['UserID']);
					$dup_auth = $this->fetchRow($select1);
					if($dup_auth)
					{	
						$UniqueID =  $dup_auth['provider_uid'];
						$OauthToken =  $dup_auth['oauth_token'];
						$Provider =  $dup_auth['provider'];
					}


					$is_new="0";
					$this->_name='users';
					$where = $this->getAdapter()->quoteInto('id = ?', $user_id);
					$val= $this->update(array("updated_at"=>$current_date, "image_url"=>$data['ProfileImageURL'], "address"=>$data['Location'], "birthDate"=>$data['BirthDate'], "gender"=>$data['Gender']), $where);

				}//end of if if($dup_out)
				else
				{
						$this->_name='users';
						$user_id= $this->insert(array('email'=>$data['Email'], "created_at"=>$current_date, "updated_at"=>$current_date, "image_url"=>$data['ProfileImageURL'],"address"=>$data['Location'],"birthDate"=>$data['BirthDate'], "gender"=>$data['Gender']));
						
						$this->_name='authentications';
						$authentications_id= $this->insert(array('user_id'=>$user_id,"provider"=>$data['Provider'], "provider_uid"=>$data['UniqueID'],"oauth_token"=>$data['OauthToken'], "created_at"=>$current_date, "updated_at"=>$current_date,"active"=>'TRUE'));
						$is_new="1";

						$gender =  $data['Gender'];
						$birthDate =  $data['BirthDate'];
						$address =  $data['Location'];
						$image_url =  $data['ProfileImageURL'];
						$email =  $data['Email'];
						$UniqueID =  $data['UniqueID'];
						$OauthToken =  $data['OauthToken'];
						$Provider =  $data['Provider'];
				
				}//end of else of if($dup_out)

			$str=$user_id."~".$is_new."~".$data['SessionID']."~".$gender."~".$birthDate."~".$address."~".$image_url."~".$email."~".$UniqueID."~".$OauthToken."~".$Provider;

			print_r($str);
			}
			catch(exception $e)
			{
				$str="error";
			}
		}
		else
		{
			$str="invalid";
		}
			return $str;
	}//end of  public function updateUserModel()


	 public function SingOutUserModel($data)
	{
		$this->_name='user_signin_session';
		$select_session_row  = $this->select()->where('user_id = ?', $data['UserID']);
		$chk_row = $this->fetchRow($select_session_row);
		if($chk_row)
		{
			$where = $this->getAdapter()->quoteInto('user_id = ?', $data['UserID']);
			$val = $this->delete($where);
			return 1;
		}
		else
		{
		return 0;
		}
	}//end of SingOutUserModel


}//end of class App_Model_User