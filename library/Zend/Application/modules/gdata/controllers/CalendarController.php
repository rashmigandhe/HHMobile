<?php

class Gdata_CalendarController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient("amude@regard-solutions.com", "regard@amude", $service);
		$service = new Zend_Gdata_Calendar($client);
		die;
    }


}

