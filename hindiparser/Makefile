TAGGER=./hindi-pos-tagger/bin/tnt -v0 -H hindi-pos-tagger/models/hindi
LEMMATIZER=./hindi-pos-tagger/bin/lemmatiser.py hindi-pos-tagger/models/hindi.lemma
TAG2VERT=./bin/tag2vert.py
NORMALIZE=./bin/normalize_vert.py
POSMOD=./bin/modify_pos.py
ADDDUMMY= ./bin/add_dummy_word.py
MERGE= ./bin/merge.py
CONVERT_NULL=./bin/convert_NULL.py
CONVERT_FORMAT=./bin/convert_format.py
TOKENIZER=./bin/unitok.py -l hindi -n 

# Normalizer replaces some of the spellings with easy spellings on which the parser or MT systems work very well. 

%.output: %.input.txt
	# uncomment below line if you require a normalizer
	cat $< | $(TOKENIZER) | sed -e 's/।/./g' | sed -e 's/^\.$$/.\n<\/s>\n<s>/g' |  $(NORMALIZE)  > $@.tmp.words
	# uncomment below line if you do not require a normalizer
	# cat $< | $(TOKENIZER) |  sed -e 's/।/./g' | sed -e 's/^\.$$/.\n<\/s>\n<s>/g'  > $@.tmp.words
	$(TAGGER) $@.tmp.words | sed -e 's/\t\+/\t/g' | $(LEMMATIZER) | $(TAG2VERT) | $(POSMOD) | cut -f1,2,3 > $@.tmp.tag
	python bin/convert_format.py $@.tmp.tag $@.tmp.tag.conll
	java -jar bin/malt.jar -c test_complete -i $@.tmp.tag.conll -o $@.tmp.output -m parse
	python bin/convert_output.py $@.tmp.output $@
	rm  *.tmp.*
	echo "Output stored in $@"

clean:
	rm  *.tmp.*

