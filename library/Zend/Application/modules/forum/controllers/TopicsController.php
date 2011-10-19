<?php

class Forum_TopicsController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {	
		
    }
	
	public function listAction(){
		$view = array();
		$id = $this->_request->getParam('id');
		$mTopics = new Forum_Models_Topics();
		$topics = $mTopics->getList();
		$view['topics'] = $topics;
		$this->view->assign('view',$view);
	}

	public function viewAction(){ 
			$id = $this->_request->getParam('id');
			$mTopics = new Forum_Models_Topics();
			$this->view->assign('topic', $topic);
	}
	
	public function deleteAction(){ 
			$id = $this->_request->getParam('id');
			$mTopics = new Forum_Models_Topics();
			$mTopics->delete('topic_id='.$id);
			exit;
	}
}

