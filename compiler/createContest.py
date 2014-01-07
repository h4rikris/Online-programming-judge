#!/usr/bin/python
import time,os,subprocess,cgi,cgitb,Cookie,sys
pathtoauth="/home/krishna/online/Online-programming-judge/compiler/auth/"
contestpath="/home/krishna/Contest/"
#displaypath="/opt/lampp/htdocs/compiler/Contests/"
l=os.listdir(pathtoauth)
cookie=Cookie.SimpleCookie()
stat=0
cry=sys.argv[1]
if cry in l:
	session_file=open(pathtoauth+cry,"r")
	sid=session_file.readlines()
	contest=sid[1][:-1]
	try:
		if contest not in os.listdir(contestpath):
			#os.mkdir(displaypath+contest)
			os.mkdir(contestpath+contest)
			os.remove(pathtoauth+cry)
			stat=2
		else:
			stat=1
	except OSError:
			stat=1
else:
	stat=3
print "Content-type:text/html\n\n"
print '<html>'
print '<head>'
print '<title>Contest create</title>'
print '</head>'
print '<body>'
print sys.argv[0]
if stat==1:
	print "Something went wrong.make sure that you have entered unique contest name"
elif stat==2:
	print "Succesfully created a contest"
elif stat==5:
	print "no values parsed"
else:
	print "Ooops...!!!! Forbidden ..... :-(" 
print '</body>'
print '</html>'
