# -*- coding: utf-8 -*-
import sys

vowels_to_be_replaced= {}

def replace_null(from_chr_num, to_chr_num):
    for x in range(from_chr_num, to_chr_num):
        vowels_to_be_replaced[unichr(x)]= ""

#replace_null(0x0900, 0x0904)
#replace_null(0x093A, 0x0950)
#replace_null(0x0951, 0x0958)
#replace_null(0x0962, 0x0964)
#replace_null(0x0971, 0x0972)

vowels_to_be_replaced[unichr(0x0901)]= unichr(0x0902)
vowels_to_be_replaced[u""]= u"न"
vowels_to_be_replaced[u"ऩ"]= u"न"
vowels_to_be_replaced[u'ऱ']= u"र"
vowels_to_be_replaced[u'ऴ']= u"ळ"
vowels_to_be_replaced[u'क़']= u"क"
vowels_to_be_replaced[u'ख़']= u"ख"
vowels_to_be_replaced[u'ग़']= u"ग"
vowels_to_be_replaced[u'ज़']= u"ज"
vowels_to_be_replaced[u'ड़']= u"ड"
vowels_to_be_replaced[u'ढ़']= u"ढ"
vowels_to_be_replaced[u'फ़']= u"फ"
vowels_to_be_replaced[u'य़']= u"य"
vowels_to_be_replaced[u'ॠ']= u"ऋ"
vowels_to_be_replaced[u'ॡ']= u"ऌ"

def normalise(word):
    # Word should be unicode encoding
    nword=""
    for chr in word:
        if vowels_to_be_replaced.has_key(chr):
            nword+= vowels_to_be_replaced[chr]
        else:
            nword+= chr
    return nword

if __name__=="__main__":
    print normalise(u"भागता")
    print normalise(u"तृष्णा")            
