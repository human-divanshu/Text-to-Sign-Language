import sys
import re

index = 1
for line in sys.stdin:
		if re.match("<\/?s", line):
				print line[:-1]
				index = 1
				continue
		elif re.match("<", line):
				print line[:-1]
				continue
		elif re.search("dummy", line):
				line = [str(index)] + line[:-1].split('\t')[1:]
				print "\t".join(line)
		else:
				print line[:-1]
		index += 1

