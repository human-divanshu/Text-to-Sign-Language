# Hindi Part of Speech (POS) Tagger

## Usage:

We support only UNIX based systems. There is nothing to do to install.

To tag the sample file given in this software, run this command

>     make tag

The sample file provided with the tool is [hindi.input.txt](./hindi-part-of-speech-tagger/src/master/hindi.input.txt). When you run the command, a file named `hindi.output` is created. For more tagging options, modify the Makefile.

For a sample output, see [hindi.sample.out.txt](./hindi-part-of-speech-tagger/src/master/hindi.sample.out.pdf).

## Output Format:

The output format contains the following columns separated by tab space.

| word | lemma |  **POS tag** | suffix | coarse pos | gender | number | case marker |
| :------: |:-----:| :-----: | :-----: | :-----: | :-----: | :-----: | :-----: | 
| वर्षों |  वर्ष | **NN** | 0 | n | m | pl | 3 | o |

You probably require only the first 3 columns. The main pos tag is highlighted in bold.

## Tagset:

We use IIIT Tagset described in [posguidelines.pdf](./hindi-part-of-speech-tagger/src/master/posguidelines.pdf) (Bharati et al., 2006). 


```

Fine Grained Tags ~~800 discarding low frequent tags.
Main POS Tag        25     CC, JJ, NN, VM, . . .
Coarse POS Tag      11      adj, n, num, unk . . .
Gender              6      any, f, m, n, punc, null
Number              4      any, pl, sg, null
Person              6      1, 2, 2h, 3, any, null
Case                4      any, d, o, null

```


## Citation:

Please cite http://sivareddy.in/downloads wherever required.

## Description

The tagger is similar to Model 5 described in Table 2 of (Reddy and Sharoff 2011), but with a focus on Hindi. Short synopsis is presented below. 

Large web corpora of Hindi is downloaded and cleaned, and tagged with with a high precision but low recall tagger. Morph analyzer is also run on this data. The tagger learns morphological analysis and pos tagging at the same time, there by pos tagging getting befitted from morphological analysis and vice versa. Since the tagger is trained on large data, the tagger is expected to handle large vocabulary, and also predicting the tags of unknown words using known words.

Current tagger is based on TnT tagger. TnT Tagger is well known for its robustness and speed, however it initially loads lex and trigram files which make take time to load. Once the loading is finished, we expect the tagger to be very fast.

## License:

The model files are distributed under GNU GPL license. Feel free to use, modify, and redistribute the files as necessary. But the TnT tagger binary files are free only for research purposes (Get a license of TnT from http://www.coli.uni-saarland.de/~thorsten/tnt/)

This work is supported by Intellitext [1] project and Lexical Computing Ltd [2] (Sketch Engine)

[1] http://corpus.leeds.ac.uk/it/

[2] http://www.sketchengine.co.uk/?page=Website/Company


## Contact:

For additional corpora and tools for other languages, please email your queries to
siva@sivareddy.in

## CORPORA DETAILS:

Trained on a corpus containing 30,409,730 tokens
Lexicon contains 471093 tokens

## Evaluation Results of Main POS tag:



```

Equal	 :   22129 /  24236 ( 91.31%)
Different:    2107 /  24236 (  8.69%)

Tag     Freq    Precision       Recall          F-Measure
=========================================================
NN	5200	0.854914	0.948462	0.899262
PSP	4006	0.983068	0.985522	0.984293
VM	2380	0.959579	0.957563	0.958570
SYM	2129	0.993430	0.994364	0.993897
JJ	1829	0.848577	0.913067	0.879642
VAUX	1536	0.962653	0.973307	0.967951
NNP	1502	0.857010	0.614514	0.715781
XC	1285	0.792956	0.578210	0.668767
PRP	1061	0.945298	0.928369	0.936757
CC	809	0.943971	0.957973	0.950920
RP	647	0.954693	0.911901	0.932806
QC	438	0.909287	0.961187	0.934517
NST	357	0.924119	0.955182	0.939394
DEM	343	0.893678	0.906706	0.900145
QF	284	0.850365	0.820423	0.835125
NEG	125	1.000000	0.992000	0.995984
RB	114	0.890000	0.780702	0.831776
INTF	83	0.787234	0.891566	0.836158
RDP	56	0.677966	0.714286	0.695652
QO	24	0.666667	0.750000	0.705882
WQ	21	1.000000	0.904762	0.950000
INJ	3	0.666667	0.666667	0.666667

```

## Acknowledgements:

[Avinesh PVS](http://www.avineshpvs.com/)

## References:

Bharati, Akshar, Rajeev Sangal, Dipti Misra Sharma, and Lakshmi Bai. "Anncorra: Annotating corpora guidelines for pos and chunk annotation for indian languages." LTRC-TR31 (2006).

Reddy, Siva, and Serge Sharoff. "Cross language POS taggers (and other tools) for Indian languages: An experiment with Kannada using Telugu resources." Cross Lingual Information Access (2011): 11.