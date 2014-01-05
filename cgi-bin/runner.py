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
import os,subprocess,time,signal,cgi,Cookie
print "Content-type:text/html\n\n"
print '<html>'
print '<head>'
print '<title>Contest |create</title>'
print '</head>'
print '<body>'
pathtoauth="/home/krishna/online/Online-programming-judge/compiler/auth/"
contestpath="/home/krishna/Contest/"
form=cgi.FieldStorage()
got_all_inputs=0
access_grant=0
error=100
max_execution_time=5 #in Seconds
if form.getvalue('cry') and form.getvalue('contest') and form.getvalue('problem') and form.getvalue('language') and form.getvalue('time_limit') and form.getvalue('filename'):
	
	cry=form.getvalue('cry')
	contest=form.getvalue('contest')
	problem=form.getvalue('problem')
	language=form.getvalue('language')
	filename=form.getvalue('filename')
	time_limit=form.getvalue('time_limit')
	l=os.listdir(pathtoauth)
	l1=os.listdir(contestpath)
	l2=os.listdir(contestpath+contest)
	languages=["python","C","Java"]
	got_all_inputs=1
	
else:
	error=1
if (got_all_inputs==1) and (cry in l) and (contest in l1) and (problem in l2) and (language in languages):
	#retriving cookie
	cookie=Cookie.SimpleCookie()
	cookie_string = os.environ.get('HTTP_COOKIE')
	cookie.load(cookie_string)
	#End of code for retriving cookie
	session_file=open(pathtoauth+cry,"r")
	sid=session_file.readlines()
	if (sid[0][0:26]==cookie["PHPSESSID"].value[0:26]) and (sid[1][:-1]==contest) and (sid[2][:-1]==problem) and (sid[3][:-1]==filename):
		access_grant=1
		os.remove(pathtoauth+cry)
	else:
		if error>3:
			error=3
else:
	if error>2:	
		error=2
if access_grant==1:
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
else:
	if error>=3:
		error=3
if error==1:
	print "Inputs are missing...!!"
elif error==2:
	print "Unauthorized access or invalid access.\nPossible problem is Specified contest or problem is invalid..."
elif error==3:
	print "You are not authorize to run this program.Please kindly login first."
