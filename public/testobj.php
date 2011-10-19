<?php
$obj_abc->success = "false";
$obj_abc->recordId = 123;
$obj_abc->Error = "Error message";

print_r(json_encode($obj_abc));

?>