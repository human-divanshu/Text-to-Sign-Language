# Hindi Dependency Parser 

## Usage:

Your input file should have the extension .input.txt e.g. `hindi.input.txt`
To dependency tag your input file run "make <filename>.output" e.g. 

> make hindi.output

This will create a file named `hindi.output`

See [hindi.input.txt](https://bitbucket.org/sivareddyg/hindi-dependency-parser/src/master/hindi.input.txt) and [hindi.dependency.parser.out.txt](https://bitbucket.org/sivareddyg/hindi-dependency-parser/src/master/hindi.dependency.parser.out.pdf) for sample input and output files. You can change the entries in Makefile to work with any desired input.

## Output format

The output format contains the following columns separated by tab space.

| word id | word | lemma | POS Tag | parent id | dependency label |
| :------: |:-----:| :-----: | :-----: | :-----: | :-----: |
| 8 | वर्षों  | वर्ष | NN | 12 | k7t |


## Dependency Tagset:

See [dep-tagset.pdf](https://bitbucket.org/sivareddyg/hindi-dependency-parser/src/master/dep-tagset.pdf) for the dependency tagset details. The tagset is briefly described in [1].

## Description: 

We train and test Malt Dependency Parser [2] on Hindi ICON 2010 shared task data [3]. We use the features word, lemma and postag (for postposition tags we lexicalize the tag by appending the word to the tag). You can build a better parser using other features such as morphological information, which we do not do here.


```
Parser Accuracy: (Parser trained on features word, lemma and postag)

  Labelled   attachment score: 4948 / 6588 * 100 = 75.11 %
  Unlabelled attachment score: 5555 / 6588 * 100 = 84.32 %
  Label accuracy score:       5199 / 6588 * 100 = 78.92 %

```



## Citation:

Please cite http://sivareddy.in/downloads wherever required.

## License:

Free to use for research purpose. You have to get a license from [LTRC IIIT Hyderabad] (http://ltrc.iiit.ac.in) for commercial purposes. Please contact us for additional details.


## Contributors:

Siva Reddy
http://sivareddy.in
siva@sivareddy.in

Anil Krishna Eragani
eragani@gmail.com

## Acknowledgements:

[Bharat Ram Ambati](http://sites.google.com/site/bharatambati)

## References

[1] Begum, Rafiya, Samar Husain, Arun Dhwaj, Dipti Misra Sharma, Lakshmi Bai, and Rajeev Sangal. "Dependency Annotation Scheme for Indian Languages." In IJCNLP, pp. 721-726. 2008.

[2] Nivre, Joakim, Johan Hall, and Jens Nilsson. "Maltparser: A data-driven parser-generator for dependency parsing." Proceedings of LREC. Vol. 6. 2006.

[3] Husain, Samar, Prashanth Mannem, Bharat Ram Ambati, and Phani Gadde. "The ICON-2010 tools contest on Indian language dependency parsing." Proceedings of ICON-2010 Tools Contest on Indian Language Dependency Parsing, ICON 10 (2010): 1-8.