import sys
import re

f = open(sys.argv[1],'r');
a = f.read();
a = re.sub('\n\n\n','\n\n',a);
a = a.split('\n');
f.close();

f = open(sys.argv[2],'w');
index = 1;

for i in a:
    i=i.strip('\n').split('\t');
    if len(i)>2:
        j=[ str(index), i[0], i[2][:-2], '_', i[1], '_|_|_|_|_', '_', '_', '_', '_' ];
        f.write('\t'.join(j)+"\n");
        index = index + 1;
    else:
        index = 1;
        f.write("\n");

f.close();
