<?php
 
class Gdata_Models_Calendar extends Zend_Db_Table_Abstract
{
	//protected $_name = 'test';

function getCurrentUrl(){
    global $_SERVER;
    // Filter php_self to avoid a security vulnerability.
    $php_request_uri =htmlentities(substr($_SERVER['REQUEST_URI'],0,strcspn($_SERVER['REQUEST_URI'], "\n\r")),ENT_QUOTES);
    if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
		 $protocol = 'https://';

    } else {

        $protocol = 'http://';

    }

    $host = $_SERVER['HTTP_HOST'];

    if ($_SERVER['HTTP_PORT'] != '' &&

        (($protocol == 'http://' && $_SERVER['HTTP_PORT'] != '80') ||

        ($protocol == 'https://' && $_SERVER['HTTP_PORT'] != '443'))) {

        $port = ':' . $_SERVER['HTTP_PORT'];

    } else {

        $port = '';

    }

    return $protocol . $host . $port . $php_request_uri;

}




}

