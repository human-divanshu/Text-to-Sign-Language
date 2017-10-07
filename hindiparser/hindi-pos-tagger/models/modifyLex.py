# -*- coding: utf-8 -*-
import sys
import re

character_range= u"\u0900-\u097F"
number_range= u"\u0966-\u096F"

while 1:
	line= sys.stdin.readline()
	if line[0:2]=="%%":
		sys.stdout.write(line)
	else:
		break

sys.stdout.write("@USECASE\t\t\t1\n")
sys.stdout.write("@UNKNOWN\t\t\t500000\tUNK\t500000\n")
sys.stdout.write("@CARD\t\t\t500000\tQC.num....\t500000\n")
sys.stdout.write("@CARDSUFFIX\t\t\t500000\tQC.num....\t500000\n")
sys.stdout.write("@CARDSEPS\t\t\t500000\tQC.num....\t500000\n")
sys.stdout.write("@CARDPUNCT\t\t\t500000\tQC.num....\t500000\n")
for char in range(ord('!'), ord('/')+1):
	sys.stdout.write("%s\t\t\t500000\tSYM.punc....\t500000\n" %(chr(char)))
for char in range(ord(':'), ord('@')+1):
	sys.stdout.write("%s\t\t\t500000\tSYM.punc....\t500000\n" %(chr(char)))
for char in range(ord('['), ord('`')+1):
	sys.stdout.write("%s\t\t\t500000\tSYM.punc....\t500000\n" %(chr(char)))
for char in range(ord('{'), ord('~')+1):
	sys.stdout.write("%s\t\t\t500000\tSYM.punc....\t500000\n" %(chr(char)))

while line!="":
	fields= line.split()
	if line[0]=="@" or len(fields)<4:
		line= sys.stdin.readline()
		continue
	if re.search(u'^[0-9%s][0-9%s\!-\,\/\:-\@\[-\`\{-\~]*$' %(number_range, number_range) , fields[0].decode('utf-8', 'replace'))!=None and fields[1].isdigit():
		sys.stdout.write("%s\t\t\t%s\tQC.num....\t%s\n" %(fields[0], fields[1], fields[1]))
	elif re.search(u"^[\!-\/\:-\@\[-\`\{-\~][\!-\/\:-\@\[-\`\{-\~]+$", fields[0].decode('utf-8', 'replace'))!=None and fields[1].isdigit():
		sys.stdout.write("%s\t\t\t%s\tSYM.punc....\t%s\n" %(fields[0], fields[1], fields[1]))
	elif re.search(u'^[%s][%s\-\.]*$' %(character_range, character_range), fields[0].decode("utf-8", "replace"))!=None and fields[1].isdigit():
		sys.stdout.write(line)
	line= sys.stdin.readline()
