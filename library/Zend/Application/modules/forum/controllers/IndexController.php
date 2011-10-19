<?php

class Forum_IndexController extends Zend_Controller_Action
{

    public function init()
    {
		
    }

    public function indexAction()
    {	
		$mForums = new Forum_Models_Forums();
		$forums = $mForums->fetchAll();
		$this->view->assign('forums',$forums);
    }

	public function viewAction(){ 
			$id = $this->_request->getParam('id');
			$mTopics = new Forum_Models_Topics();
			$topic = $mTopics->fetchRow('topic_id='.$id);
			$this->view->assign('topic', $topic);
	}
	
	public function deleteAction(){
		$id = $this->_request->getParam('id');
		$mForums = new Forum_Models_Forums();
		$mForums->delete('forum_id='.$id);
		exit;
	}
}

