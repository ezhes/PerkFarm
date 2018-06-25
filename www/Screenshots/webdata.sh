#!/bin/bash
#Load ADB devices
deviceList=`adb devices`
while read line
do
    if [ ! "$line" = "" ] && [ `echo $line | awk '{print $2}'` = "device" ]
    then
        device=`echo $line | awk '{print $1}'`
        #echo "Screenshotting $device $@"
		#change save location!       
        adb -s $device shell screencap -p | perl -pe 's/\x0D\x0A/\x0A/g' > "Screenshots/$device.png"
        #DATA SETUP
        frontMostApp=`adb -s $device shell ps | grep perk | awk '{print $9}'`
        #FUCKING SANTATIZED
        frontMostApp=`echo $frontMostApp | tr "\$'" " " | tr "\r" "."`
        imageLocation="/Screenshots/$device.png"
        #Read the temperature
        temperature=`adb -s $device shell dumpsys battery | grep temperature`
        #Sanatize
        
        temperature=`echo $temperature | tr "temperature: " " "| tr "\$'" " " | tr "\r" " "`
        #Divide by 1000, will loose accuracy but this should be the expected values
        temperature=`expr $temperature / 10`
        data+=" $device,$frontMostApp,$imageLocation,$temperature"
    fi
done <<<"$deviceList"
echo $data


