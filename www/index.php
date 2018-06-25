<html>
<head>
<title>PerkFarm Status</title>
<link rel="shortcut icon" href="favicon.ico"/>
<meta http-equiv="refresh" content="30">
<style>
table, th, td {
    border: 1px solid black;
}

.rotated {
    -ms-transform: rotate(270deg); /* IE 9 */
    -webkit-transform: rotate(270deg); /* Chrome, Safari, Opera */
    transform: rotate(270deg);
    margin:-95px 95px;
    height:427px;
} 
#PerkPointFrame {
width:100%;
top:0px;
height: 55px;
overflow:hidden;
}
</style>
<script>
//Useragent function
function setUserAgent(window, userAgent) {
    if (window.navigator.userAgent != userAgent) {
        var userAgentProp = { get: function () { return userAgent; } };
        try {
            Object.defineProperty(window.navigator, 'userAgent', userAgentProp);
        } catch (e) {
            window.navigator = Object.create(navigator, {
                userAgent: userAgentProp
            });
        }
    }
}
//Set useragent to fake iframe into serving desktop
setUserAgent(document.querySelector('PerkPointFrame').contentWindow, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:38.0) Gecko/20100101 Firefox/38.0');
</script>
</head>
<body>
<iframe src="http://www.perk.com/shop/" frameBorder="0" scrolling="no" id="PerkPointFrame"></iframe>
<br>
<br>
<?php
//Get data
try{
    $output = shell_exec("/home/pi/www/Screenshots/webdata.sh");
    $output = str_replace("\r", "", $output);
    $output = str_replace("\n", "", $output);
    $devices = explode( " ", $output);
    //Start the table method
    echo '<table border="4" style="width:100%">';
    //Labels
    echo "<th>Device</th><th>Active Process</th><th>Device Preview</th>";
    foreach ($devices as $device) {
    	$deviceValues = explode ( ",",$device);
    	//Start the cell
    	echo "<tr>";
    	//Name column
    	echo "<td>" . $deviceValues[0] . " (" .$deviceValues[3] . "&deg; C)" . "</td>";
    	//Process column
    	if ($deviceValues[1] == "com.juteralabs.perktv.")
    	{
    	echo '<td bgcolor="#00FF00">' . $deviceValues[1] . " (ok)" . "</td>";
    	}else
    	{
    	echo '<td bgcolor="#FF0000 ">' . "Device failure!" . "</td>";
    	}
    	//Image column
    	if ($deviceValues[0] != "192.168.1.29:5555") {
    	//Rotated
    	echo '<td> <img class="rotated" height=250 src="' . $deviceValues[2] . '"></td>';
    	}else {
    	echo '<td> <img height=250 src="' . $deviceValues[2] . '"></td>';
    	}
    	//Functions cell
    	//Put the touch button in
    	echo '<td> <a href="adb.php?device=' . $deviceValues[0] . '&command=shell+input+tap+50+120" target="_parent"><button>Touch replay</button></a>';
    	echo "<br>";
    	//Put the back button in
    	echo '<a href="adb.php?device=' . $deviceValues[0] . '&command=shell+input+keyevent+4" target="_parent"><button>Send back key</button></a>';
    	echo "<br>";
    	echo '<a href="adb.php?device=' . $deviceValues[0] . '&command=shell+input+keyevent+20" target="_parent"><button>Send down key</button></a>';
    	echo "<br>";
    	echo '<a href="adb.php?device=' . $deviceValues[0] . '&command=shell+input+keyevent+23" target="_parent"><button>Send enter key</button></a></td>';
    	//Close the cell
    	echo "</tr>";
	}
	//Close table
	echo "</table>";
}
catch (Exception $e) {
    echo "Error :" . $e->getMessage();
}


?>
<?php echo "<br>Updated last on " . date('l jS \of F Y h:i:s A'); ?>
</body>
</html>