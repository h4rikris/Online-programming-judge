#!/usr/bin/python
#Author	:	HARI KRISHNA K
def check(input_data,time_taken,l_time):
	o=open("outputs","r")
	if input_data[:-1]==o.read():
		if time_taken<=float(l_time):
			print "Congratulations...Correct answer.\n\tExecution time:",time_taken
		else:
			print "Time limit Exceeded."
	else:
		print "Wrong answer"
	o.close()
def handler(signum,frame):
	raise Exception("Couldn't open device!!")
import os,subprocess,time,signal,cgi,Cookie,sys
pathtoauth="/home/krishna/online/Online-programming-judge/compiler/auth/"
contestpath="/home/krishna/Contest/"
got_all_inputs=0
access_grant=0
error=100
max_execution_time=5 #in Seconds
contest=sys.argv[1]
problem=sys.argv[2]
filename=sys.argv[3]
language=sys.argv[4]
time_limit=sys.argv[5]
languages=["python","C","Java"]
os.chdir(contestpath+contest+"/"+problem)
signal.signal(signal.SIGALRM,handler)
command=[]
if language=="C":
	command=["cc",filename,"-o",filename[:-2]]
	out=subprocess.Popen(command,stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE).communicate()
	if len(out[1])!=0:
		print "Compile time error"
	else:
		f=open("inputs","r")
		fi=f.read()
		f.close()
		signal.alarm(max_execution_time)
		try:
			t1=time.time()
			out=subprocess.Popen("./"+filename[:-2],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE).communicate(fi)
			t2=time.time()
			if len(out[1])!=0:
				print "Run time Error"
			else:
				check(out[0],t2-t1,time_limit)
		except Exception:
			print "Your are running out of time...!!!"
elif language=="Java":
	command=["javac",filename]
	out=subprocess.Popen(command,stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE).communicate()
	if len(out[1])!=0:
		print "Compile time error"
	else:
		f=open("inputs","r")
		fi=f.read()
		f.close()
		signal.alarm(max_execution_time)
		try:
			t1=time.time()
			out=subprocess.Popen(["java",filename[:-5]],stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE).communicate(fi)
			t2=time.time()
			if len(out[1])!=0:
				print "Run time Error"
			else:
				check(out[0],t2-t1,time_limit)
		except Exception:
			print "Your are running out of time...!!!"
elif language=="python":
	command=["python",filename]
	f=open("inputs","r")
	fi=f.read()
	f.close()
	signal.alarm(max_execution_time)
	try:
		t1=time.time()
		out=subprocess.Popen(command,stdin=subprocess.PIPE,stdout=subprocess.PIPE,stderr=subprocess.PIPE).communicate(fi)
		t2=time.time()
		if len(out[1])!=0:
			print "Error"
		else:
			check(out[0],t2-t1,time_limit)
	except Exception:
		print "Your are running out of time...!!!"
else:
	print "Invalid language"
if error==1:
	print "Inputs are missing...!!"
elif error==2:
	print "Unauthorized access or invalid access.\nPossible problem is Specified contest or problem is invalid..."
elif error==3:
	print "You are not authorize to run this program.Please kindly login first."
