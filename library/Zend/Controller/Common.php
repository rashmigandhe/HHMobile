<?php

/**
 * {0}
 * 
 * @author Ashish Mude
 * @version 1.0
 */
abstract class Zend_Controller_Common extends Zend_Controller_Action {
	/**
	 * The default action - show the home page
	 */
	public function init() {
				
	}
	
	function seoUrl($string) {
		$string = preg_replace ( "`\[.*\]`U", "", $string );
		$string = preg_replace ( '`&(amp;)?#?[a-z0-9]+;`i', '-', $string );
		$string = htmlentities ( $string, ENT_COMPAT, 'utf-8' );
		$string = preg_replace ( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string );
		$string = preg_replace ( array ("`[^a-z0-9]`i", "`[-]+`" ), "-", $string );
		return strtolower ( trim ( $string, '-' ) );
	}
	
	function getPaginationLink($pager,$path) {
		if ($pager->pageCount) :
			$pagerLink = '';
			$pagerLink .= '<div class="paginationControl">';
			if (isset ( $pager->previous )) :
				$pagerLink .= ' <a href="' . $path .'/' . $pager->previous . ' ">
    &lt; Previous
  </a> |';
			 else :
				$pagerLink .= '<span class="disabled">&lt; Previous</span> |';
			endif;
			foreach ( $pager->pagesInRange as $page ) :
				if ($page != $pager->current) :
					$pagerLink .= ' <a href="' . $path .'/'. $page . '">' . $page . ' 
    </a> |';
				 else :
					$pagerLink .= $page . '  |';
				endif;
			endforeach
			;
			if (isset ( $pager->next )) :
				$pagerLink .= '<a href="' . $path .'/' . $pager->next . '">
    Next &gt;
  </a>';
			 else :
				$pagerLink .= '<span class="disabled">Next &gt;</span>';
			endif;
			$pagerLink .= '</div>';
		
			
		
 endif;
		return $pagerLink;
	}
	
	
	
}

