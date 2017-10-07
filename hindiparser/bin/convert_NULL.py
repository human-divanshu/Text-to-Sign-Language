#!/usr/bin/env python

# -*- coding: utf-8 -*-

import sys

f1 = open(sys.argv[1],'r'); ## gold
f2 = open(sys.argv[2],'r'); ## siva generated

f3 = sys.stdout ## NULL POS replaced .. output

null_list = [];
join_list = [];

for i in f1:
	if 'NULL' in i:
		i = i.split('\t');
		null_list.append(i[4]);

for i in f2:
	if not i.split('\t') > 2:
		f3.write(i);
	else:
		tmp = i.split('\t');
		if 'LL' in i:
			tmp[2] = null_list.pop(0);
		f3.write('\t'.join(tmp));

f1.close();
f2.close();
f3.close();

