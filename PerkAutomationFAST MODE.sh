#First manually connect to remote devices. Wait 45 seconds for network to lock
sleep 45        ######ENABLE AGAIN!!
#Kill and relaunch the server
sudo adb kill-server
sudo adb start-server
#Connect to Galaxy Tab
sudo adb connect 192.168.1.29
echo "Will manage these devices:"
sudo adb devices
while [ true ]
do
#
# ONLY MELROSE AND DASH, GALAXY DOES NOT SUPPORT
#
#Hit the back key. This skips a video but not an ad
adb -s BLUDASH0 shell input keyevent 4
adb -s 0123456789ABCDEF shell input keyevent 4
#Galaxy does nothing
#Sleep to add some buffer time
sleep 5

#Touch to restart incase it broke
adb -s BLUDASH0 shell input tap 50 120
adb -s 0123456789ABCDEF shell input tap 50 120
#More buffer
sleep 5

#
# ALL DEVICES
#
#Press the down key. If theres an alert on screen this will select the first option.This also starts playing the first video if the timing is off from the above
sudo adb+ shell input keyevent 20
#Press enter, dismissing the alert or starting the next video
sudo adb+ shell input keyevent 23

echo "Done with this round, going to sleep"
sleep 30
echo "Here we go again..."

#Hit the back key. This skips a video but not an ad
#sudo adb+ shell input keyevent 4
#Just add more buffer
#sleep 5
#Click first video in queue
#sudo adb+ shell input tap 50 120
#Sleep 5 seconds to keep up with the slow devices
#sleep 5
#Press the down key. If theres an alert on screen this will select the first option.This also starts playing the first video if the timing is off from the above
#sudo adb+ shell input keyevent 20
#Press enter, dismissing the alert or starting the next video
#sudo adb+ shell input keyevent 23
#echo "Done running, will sleep"
#Rerun after 30 seconds
#sleep 30
#echo "Going again"
done
