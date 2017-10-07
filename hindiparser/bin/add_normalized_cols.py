# -*- coding: utf-8 -*-
import sys
#from remove_extra_vowels import normalise
from normalize_bojar_lrec_2010 import normalise

for line in sys.stdin:
    if line[0]=="<":
        print line.strip()
        continue
    line= line.strip("\n")
    cols= line.split("\t")
    if len(cols)<9:
        print line
        continue
    else:
        nword= normalise(cols[0].decode("utf-8", 'replace')).encode("utf-8")
        nlemma= normalise(cols[2].decode("utf-8", 'replace')).encode("utf-8")
        #print [nword, nlemma]
        print "%s\t%s\t%s" %(line, nword, nlemma)
