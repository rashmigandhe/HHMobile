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
			echo "dup_out:";
			print_r(sizeof($dup_out));
			if($dup_out)
			{
				$user_id =  $dup_out['id'];
				$is_new="0";
				$str=$user_id."~".$is_new;
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
					$str=$user_id."~".$is_new;
				}
				else
				{
					$this->_name='users';
					$user_id= $this->insert(array('email'=>$data['Email'], "created_at"=>$current_date, "updated_at"=>$current_date, "image_url"=>$data['ProfileImageURL'],"address"=>$data['Location'],"birthDate"=>$data['BirthDate'], "gender"=>$data['Gender']));
					
					$this->_name='authentications';
					$authentications_id= $this->insert(array('user_id'=>$user_id,"provider"=>$data['Provider'], "provider_uid"=>$data['UniqueID'],"oauth_token"=>$data['OauthToken'], "created_at"=>$current_date, "updated_at"=>$current_date,"active"=>'TRUE'));
					$is_new="1";
					$str=$user_id."~".$is_new;
				}

			}//end of else
			return $str;
		}
		catch(exception $e)
		{
		
			print_r($e->getMessage());
			$str="0~0";
		}
		return $str;
	}//end of  public function addUserModel()






public function updateUserModel($data)
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
				$is_new="0";
				$str=$user_id."~".$is_new;
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
					$str=$user_id."~".$is_new;

				}//end of if($dup_out1)
				else
				{
					$this->_name='users';
					$user_id= $this->insert(array('email'=>$data['Email'], "created_at"=>$current_date, "updated_at"=>$current_date, "image_url"=>$data['ProfileImageURL'],"address"=>$data['Location'],"birthDate"=>$data['BirthDate'], "gender"=>$data['Gender']));
					
					$this->_name='authentications';
					$authentications_id= $this->insert(array('user_id'=>$user_id,"provider"=>$data['Provider'], "provider_uid"=>$data['UniqueID'],"oauth_token"=>$data['OauthToken'], "created_at"=>$current_date, "updated_at"=>$current_date,"active"=>'TRUE'));
					$is_new="1";
					$str=$user_id."~".$is_new;
				}//end of else if($dup_out1)

			}//end of else of if($dup_out)
			return $str;
		}
		catch(exception $e)
		{
		
			print_r($e->getMessage());
			die();
			$str="0~0";
		}
		return $str;
	}//end of  public function updateUserModel()














}//end of class App_Model_User