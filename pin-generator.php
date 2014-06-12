<?php
// Author: Ewere Diagboya

mysql_connect("localhost","root","");

// GUID Generator
function generateGuid($include_braces = false) {
    if (function_exists('com_create_guid')) {
        if ($include_braces === true) {
            return com_create_guid();
        } else {
            return substr(com_create_guid(), 1, 36);
        }
    } else {
        mt_srand((double) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
       
        $guid = substr($charid,  0, 8) . '' .
                substr($charid,  8, 4) . '' .
                substr($charid, 12, 4) . '' .
                substr($charid, 16, 4) . '' .
                substr($charid, 20, 12);
 
        if ($include_braces) {
            $guid = '{' . $guid . '}';
        }
   
        return $guid;
    }
}

if(isset($_POST['genrate'])) {
	$pindigit = $_POST['pindigit'];
	$pintotal = $_POST['pintotal'];
	for ($i=0;$i<=$pintotal; $i++) {
	$pin =  str_replace('-', '', generateGuid())  . "<br />";
	$spin = substr($pin,0,$pindigit) . '<br />';
	echo $spin;
}
}
?>
<html>
<form method="post">
Enter number of PINs to Generate: <input name="pintotal" type="text" /><br />
PIN Digits: <input name="pindigit" type="text" /><br />
<input  type="submit" name="genrate" value="Generate" />
</form>
</html>
