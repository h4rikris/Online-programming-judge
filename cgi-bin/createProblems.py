#!/usr/bin/python
import time,os,cgi,cgitb,Cookie,urllib
pathtoauth="/opt/lampp/htdocs/compiler/auth/"
contestpath="/home/krishna/Contest/"
#displaypath="/opt/lampp/htdocs/compiler/Contests/"
l=os.listdir(pathtoauth)
form=cgi.FieldStorage()
cookie=Cookie.SimpleCookie()
stat=0
if form.getvalue('cry') and form.getvalue('contest') and form.getvalue('inputs') and form.getvalue('outputs') and form.getvalue('title'):
	cry=form.getvalue('cry')
	if cry in l:
		
		#retriving cookie
		cookie_string = os.environ.get('HTTP_COOKIE')
		cookie.load(cookie_string)
		#End of code for retriving cookie
		
		session_file=open(pathtoauth+cry,"r")
		sid=session_file.read()
		if sid[0:26]==cookie["PHPSESSID"].value[0:26]:
			contest=form.getvalue('contest')
			inputs=urllib.unquote(form.getvalue('inputs'))
			outputs=urllib.unquote(form.getvalue('outputs'))
			title=form.getvalue('title')
			try:
				if contest in os.listdir(contestpath):
					os.mkdir(contestpath+contest+"/"+title)
					input_file=open(contestpath+contest+"/"+title+"/inputs","w")
					input_file.write(inputs)
					output_file=open(contestpath+contest+"/"+title+"/outputs","w")
					output_file.write(outputs)
					os.remove(pathtoauth+cry)
					stat=2
				else:
					stat=1
			except OSError:
					stat=1
		else:
			stat=3
	else:
		stat=6
else:
	stat=5
print "Content-type:text/html\n\n"
print '<html>'
print '<head>'
print '<title>Contest create</title>'
print '</head>'
print '<body>'
if stat==1:
	print "Something went wrong.make sure that you have entered unique contest name and problem name"
elif stat==2:
	print "Succesfully inserted the problem"
elif stat==5:
	print "no values parsed"
else:
	print "Ooops...!!!! Forbidden ..... :-(" 
print '</body>'
print '</html>'
