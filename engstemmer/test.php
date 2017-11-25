<?php
/*
	Convert given english sentence to
	its root word
*/
include('vendor/autoload.php');


use Wamania\Snowball\English;
use NlpTools\Stemmers\GreekStemmer;
use NlpTools\Stemmers\LancasterStemmer;
use NlpTools\Stemmers\PorterStemmer;
use NlpTools\Stemmers\RegexStemmer;

use Skyeng\Lemmatizer;
use Skyeng\Lemma;

$stemmer = new English();
$s1 = new GreekStemmer();
$s2 = new LancasterStemmer();
$s3 = new PorterStemmer();
// $s4 = new RegexStemmer();

$word = "footballs";	


$lemmatizer = new Lemmatizer();

echo $lemmatizer->getOnlyLemmas($word)[0]; 
echo "\n";
echo $stemmer->stem($word);
echo "\n";
echo $s1->stem($word);
echo "\n";
echo $s2->stem($word);
echo "\n";
echo $s3->stem($word);
// echo "\n";
// echo $s4->stem($word);
?>