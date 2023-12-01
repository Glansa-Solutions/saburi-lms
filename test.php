<?php
include("includes/header.php");
function encrypt($string, $key=5) {
	$result = '';
	for($i=0, $k= strlen($string); $i<$k; $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result .= $char;
	}
	return base64_encode($result);
}
function decrypt($string, $key=5) {
	$result = '';
	$string = base64_decode($string);
	for($i=0,$k=strlen($string); $i< $k ; $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}

echo $_SERVER['REMOTE_ADDR'];
$encypid = 8519998738;

$encypid1 = encrypt($encypid);
$encypid2 = decrypt($encypid1);
echo "<pre>";
echo "original: $encypid</br>";
echo "encrypted: $encypid1</br>";
echo "decrypted: $encypid2";
echo "</pre>";

$num = strlen($encypid);
echo $num;




include("includes/footer.php");
?>