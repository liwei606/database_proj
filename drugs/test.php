<?php 
$str = "wei"; 
echo "The string: ".$str."<br>"; 
echo "TRUE - Raw 20 character binary format: ".sha1($str, TRUE)."<br>"; 
echo "FALSE - 40 character hex number: " .sha1($str . sha1('123')); 
?>