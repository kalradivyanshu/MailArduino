import json
import urllib2
import serial
import time
while 1:
	response = urllib2.urlopen('http://192.168.1.2/readmail.php')
	json_data = json.loads(response.read())
	for x in json_data:
		ser = serial.Serial('/dev/ttyACM0', 9600)
		towrite = "F:"+str(x['From'])
		ser.write(towrite)
		print(towrite)
		time.sleep(3)
		towrite = "S:"+str(x['Subject'])
		ser.write(towrite)
		print(towrite)
		time.sleep(3)
		towrite = "D:"+str(x['Date'])
		ser.write(towrite)
		print(towrite)
		time.sleep(3)