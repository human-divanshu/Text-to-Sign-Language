#!/usr/bin/env python

'''
This file takes Reddy and Sharoff, 2011 tagger's output and split the tags into vert columns 
'''

import sys
import re

def tag2letter(tag):
    if re.match("NEG", tag):
        return "x"
    elif re.match("^[JNV]", tag):
       return tag[0].lower()
    elif re.match("RB", tag):
       return "r"
    elif re.match("PRP", tag):
       return "d"
    elif re.match("PSP", tag):
       return "p"
    elif re.match("XC", tag):
        return "n"
    elif re.match("CC", tag):
       return "c"
    elif re.match("INJ", tag):
       return "i"
    else:
       return "x"

for line in sys.stdin:
    line= line.strip()
    if line=="" or line[0]=="<":
        sys.stdout.write(line + '\n')
    else:
        fields= line.split("\t")
        if len(fields)==3:
            word= fields[0]
            tag= re.findall("^(.*)\.(.*?)\.(.*?)\.(.*?)\.(.*?)\.(.*?)$", fields[1])
            #print tag
            if tag==[]:
               tagSplit= ['UNK', '', '', '', '', '']
            else:
               tagSplit= tag[0]
            #print fields[2]
            (lemma, suffix)=  re.findall("^(.*)\.(.*?)$", fields[2])[0]
            if lemma=="":
                lemma= word
            lempos= lemma + "-" + tag2letter(tagSplit[0])
            sys.stdout.write("%s\t%s\t%s\t%s\t%s\n" %(word, tagSplit[0], lempos, suffix, "\t".join(tagSplit[1:])))
        else:
            sys.stdout.write(line+'\n')
