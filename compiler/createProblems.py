#!/usr/bin/python
import time,os,cgi,cgitb,Cookie,urllib,sys
pathtoauth="/home/krishna/online/Online-programming-judge/compiler/auth/"
contestpath="/home/krishna/Contest/"
#displaypath="/opt/lampp/htdocs/compiler/Contests/"
l=os.listdir(pathtoauth)
stat=0
contest=sys.argv[1]
title=sys.argv[2]
f1=open("/tmp/"+sys.argv[3],"r")
f2=open("/tmp/"+sys.argv[4],"r")
inputs=f1.read()
outputs=f2.read()
try:
	if contest in os.listdir(contestpath):
		os.mkdir(contestpath+contest+"/"+title)
		input_file=open(contestpath+contest+"/"+title+"/inputs","w")
		input_file.write(inputs)
		output_file=open(contestpath+contest+"/"+title+"/outputs","w")
		output_file.write(outputs)
		stat=2
	else:
		stat=1
except OSError:
		stat=1
if stat==1:
	print "Something went wrong.make sure that you have entered unique contest name and problem name"
elif stat==2:
	print "1"
elif stat==5:
	print "no values parsed"
else:
	print "Ooops...!!!! Forbidden ..... :-(" 
print '</body>'
print '</html>'
