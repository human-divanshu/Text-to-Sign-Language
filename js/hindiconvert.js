function converttohindi(hindidata)
{
	allwords = hindidata.trim().split(" ");
	rurl = "https://www.google.com/inputtools/request?text="+word+"&ime=transliteration_en_hi&num=5&cp=0&cs=0&ie=utf-8&oe=utf-8&app=jsapi";
	$.get(rurl, function(data, status){		
        console.log(data);
    });
}