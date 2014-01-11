#!/usr/bin/python
#Author	:	HARI KRISHNA K
import os,sys
contestpath="/home/krishna/Contest/"
contest=sys.argv[1]
pcode=sys.argv[2]
user=sys.argv[3]
l=os.listdir(contestpath)
l1=os.listdir(contestpath+contest)
l2=os.listdir(contestpath+contest+"/"+pcode)
if (contest in l) and (pcode in l1):
	if user in l2:
		os.mkdir(contestpath+contest+"/"+pcode+"/"+user)
	print "1"
else:
	print "0"
