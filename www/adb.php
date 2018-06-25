<?php
$device = $_GET["device"];
$adbCommand = $_GET["command"];
echo "adb -s " . $device . " " .$adbCommand;
$output = shell_exec("adb -s " . $device . " " .$adbCommand);
echo $output;
?>