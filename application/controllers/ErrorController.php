<?php
/**
 * ErrorController
 * @Author :
 * @Version : 1.0
 */

class ErrorController extends Zend_Controller_Action
{

	/**
	 *
	 * This is the Error Action used to handle the error messages.
	 */	
public function errorAction()
	{
		 $errors = $this->_getParam('error_handler');
		 $exception = $errors->exception;
		 	
	  	 $this->view->err_msg = $exception->getMessage();
	  	 $this->view->err_str= $exception->getTraceAsString();
	
			
	switch ($errors->type) 
	{
		case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
			 $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
            $content ="<p>The page you requested was not found.</p>";
			$this->view->message = $content;
		   break;
      	case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
				 $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
            $content ="<p>The page you requested was not found.</p>";
			$this->view->message = $content;
		break;
	    case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
		 	$this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
           	 $content ="<h1>Error!</h1>
				<p>The page you requested was not found.</p>";
				$this->view->message = $content;
		break;
		default:
				$content ="<p>An unexpected error occurred. Please try again later.</p>";
				$this->view->err_msg =  $exception->getMessage();
				break;
		}
							
	}//end of action
	
	


}//end of class

