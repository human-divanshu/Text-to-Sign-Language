#!/usr/bin/env python

'''

This functionality is similar to bash command "join", except that it does not compare columns before merging.
***Caution: *** : The number of lines in both the files should be the same. The delimiter is tab

python merge.py file1 file2 1.1 1.2 2.1 2.3 

'''

import sys
import commands

if len(sys.argv)<4:
	print "Usage: python merge.py file1 file2 1.1 1.2 2.1 2.3"
	exit()

count1= int(commands.getoutput("wc -l %s" %(sys.argv[1])).split()[0])
count2= int(commands.getoutput("wc -l %s" %(sys.argv[2])).split()[0])

file1= open(sys.argv[1])
file2= open(sys.argv[2])

if count1!=count2:
	print "Files differ in number of lines!! Cannot join them."
	exit()

while 1:
	line1= file1.readline()
	line2= file2.readline()
	if line1=="" or line2=="":
		break
	cols1= line1[:-1].split('\t')
	cols2= line2[:-1].split('\t')
	cols= (cols1, cols2)
	line= ""
	for arg in sys.argv[3:]:
		col_field= arg.split(".")
		file_id= int(col_field[0])
		field_id= int(col_field[1])
		if len(cols[file_id - 1]) < field_id:
			field=""
		else:
			field=cols[file_id-1][field_id-1]
		line+= "%s\t" %(field)
	print line[:-1]
