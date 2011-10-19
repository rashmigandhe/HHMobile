<?php

class Forum_Models_Forums extends Zend_Db_Table_Abstract
{
	protected $_name = 'forums';
	protected $_primary = 'forum_id';
	protected $_referenceMap = array( 
        	'Topics' => array( 
            'columns'    => array('topic_id','title'), 
            'refTableClass' => 'Forum_Models_Topics',
            'refColumns' => array('topic_id') ,
			'refTable'   => 'topics', 
			'onDelete'   => self::CASCADE, 
            'onUpdate'   => self::CASCADE 
        ));
}