#First manually connect to remote devices. Wait 45 seconds for network to lock
sleep 45
#Galaxy
sudo adb connect 192.168.1.29
echo "Will managed these devices:"
sudo adb devices
while [ true ]
do
#Press the down key. If theres an alert on screen this will select the first option
#ADB+ is used to run it on ALL devices that are active
sudo adb+ shell input keyevent 20
#Press enter, dismissing the alert
sudo adb+ shell input keyevent 23
echo "Done running, will sleep"
sleep 30
echo "Going once again"
done
