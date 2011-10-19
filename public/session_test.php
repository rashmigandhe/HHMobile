	<?php
		session_start();
		$http_session_val = session_id();
		echo "http_session_val=$http_session_val<br>";
		if(isset($_SESSION['http_session_val']))
		{
		}
		else
		{
			$_SESSION['http_session_val'] = $http_session_val;
		}
		print_r($_SESSION['http_session_val']);
	?> 

