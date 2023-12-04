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
?>

<!-- Your main content goes here -->

<button onclick="showAlert()">Show Alert</button>

<div class="alert" id="myAlert">
    <span class="closebtn" onclick="closeAlert()">&times;</span>
    <p>This is a stylish alert!</p>
</div>

<style>
	body {
    font-family: Arial, sans-serif;
}

.alert {
    position: fixed;
    top: 0;
    right: -300px; /* Adjust this value to control the initial position */
    width: 300px;
    background-color: green;
    color: #fff;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
}

.alert p {
    margin: 0;
}

.closebtn {
    cursor: pointer;
    float: right;
    font-size: 20px;
    font-weight: bold;
}

.closebtn:hover {
    color: #333;
}

</style>

<script>
	function openAlert() {
    document.getElementById("myAlert").style.right = "0";
}

function closeAlert() {
    document.getElementById("myAlert").style.right = "-300px";
}

function showAlert() {
    openAlert();
}

</script>

<?php
include("includes/footer.php");
?>