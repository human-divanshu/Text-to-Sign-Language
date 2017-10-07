import sys
import re

f = open(sys.argv[1],'r');
a = f.read().split('\n');
f.close();

f = open(sys.argv[2],'w');

for i in a:
    i=i.strip('\n').split('\t');
    if len(i)>2:
        j=[ i[0], i[1], i[2], i[4], i[6], i[7] ];
        f.write('\t'.join(j)+"\n");
    else:
        f.write("\n");

f.close();
