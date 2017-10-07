import sys
f = open(sys.argv[1],'r');
sents = f.read().split('\n</s>\n<s>\n');
f.close();

for sent in sents:
	if not sent:
		continue;
	words = sent.split('\n');
	finale = int(words[-2].split()[0])+1;
	words[-1] = '\t'.join([str(finale)]+[i for i in words[-1].split('\t')][1:]);
	word_ind = 0;
	while word_ind < len(words):
		if words[word_ind].split('\t')[4] == '0':
			words[word_ind] = '\t'.join(words[word_ind].split('\t')[:4]+[str(finale)]+words[word_ind].split('\t')[5:]);
		word_ind += 1;
	print '\n'.join(words);
	print '</s>'+'\n'+'<s>';
			
