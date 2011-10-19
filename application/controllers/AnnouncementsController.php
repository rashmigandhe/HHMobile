<?php

class AnnouncementsController extends My_Rest_Controller
{

	public function getAction()
		{
		$functionName = $this->_getParam('id');
    //	echo "in get action<br>in functionName=$functionName<br>";
    	$data = array();
    	if ($functionName=='add') 
			{
				$data['response'] = $this->addAnnouncement();
			}

	   	$data['status'] = 'success';
		$response = $this->sendResponse($data);
	}



	public function postAction() {
		$functionName = $this->_getParam('id');
		$name = $this->_getParam('name');
	//	echo "in get action<br>in functionName=$functionName<br>";

		if ($functionName=='list') {
			$data['response'] = $this->listAnnouncements();
		}

		$data['status'] = 'success';
		 
		$this->sendResponse($data);
	}

	protected function addAnnouncement() {
		
		$type = $this->_getParam('type');
		$title = $this->_getParam('title');
		$text = $this->_getParam('text');

		$response = array(
				'id' => '33344'
		);

		return $response;
		
	}

	
	/**
	 * list all announcements
	 */
	protected function listAnnouncements() {
	//echo "in list123<br>";
	

	try
		{
		$obj = new App_Model_User();
		$result= $obj->listUser();
		$my_result1=array();
	
		$obj->success = "1";
		for($i=0;$i<=1;$i++)
			{
				//	echo "in for $i::".$result[$i]['email']."<br>";
				
					$my_result1[$i]['id'] = $result[$i]['id']; 
					$my_result1[$i]['email'] = $result[$i]['email']; 
				

			}

				
		}
		catch(exception $e)
		{
			echo $e->getMessage();
		}


	
		/*$data = array
			(
			'Data'=>	array (
						'id' => '1',
						'title' => 'Rashmi'
					),
					array (
						'id' => '2',
						'title' => 'Abhiram'
					),
					array (
						'id' => '3',
						'title' => 'Ved'
					)
				);*/

		print_r($my_result1);

		echo "<br>";
				echo "<br>";
		
		return $my_result1;
	}
	
	

}