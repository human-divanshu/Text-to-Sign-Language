# -*- coding: utf-8 -*-
import sys
import re
for line in sys.stdin:
	fields= line.decode("utf-8", 'ignore').strip().split()
	if re.search(u'^[\u0900-\u097F][\u0900-\u097F\-\.]+$', fields[0])!=None:
		selFields= []
		for i in range(0, len(fields[1:]), 2):
			if fields[0][0:1]==fields[i+2][0:1]:
				selFields.append(fields[i+1] + " " + fields[i+2])
		if selFields!=[]:
			sys.stdout.write(fields[0].encode('utf-8')+"\t"+"\t".join(selFields).encode('utf-8')+"\n")
