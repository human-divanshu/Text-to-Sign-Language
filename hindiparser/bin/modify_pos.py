#!/usr/bin/env python
# -*- coding: utf-8 -*-
import sys
for line in sys.stdin:
    if line[0]=='<':
        sys.stdout.write(line)
        continue
    cols= line[:-1].split('\t')
    if len(cols)<2:
        sys.stdout.write(line)
        continue
    if cols[1]=="PSP" or cols[1]=="CC":
        cols[1]+= ":" + cols[2][:-2]
    elif cols[1]=="SYM":
        if cols[0]=="।":
            cols[1]="."
        else:
            cols[1]= cols[0]
    print '\t'.join(cols)
