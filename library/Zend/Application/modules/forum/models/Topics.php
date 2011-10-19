<?php

class Forum_Models_Topics extends Zend_Db_Table_Abstract
{
	protected $_name = 'topics';
	protected $_primary = 'topic_id';
	protected $_dependentTables = array( 
        'Forum_Models_Forums' 
    );
		
	public function getList(){
		
		$db = Zend_Registry::get('db');
		$query = "select t.*,count(r.topic_id) as replies from topics t left join replies r on t.topic_id = r.topic_id group by r.topic_id order by t.date_created Desc";
		return  $db->fetchAll($query);
	}
}

