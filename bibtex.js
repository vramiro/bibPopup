/*
* Load Bibliography from PLEIAD Site
*/

//Event.observe(window, 'load', load_bibtex, false);

function load_bibtex(author){
     var url = '/bibtex/bibtex_proxy.php?a=' + author;
     var target = 'bibtex';
     var myAjax = new Ajax.Updater(target, url, {method: 'get', onComplete: search});
}

function search(){ 
  var url = window.location.toString(); var pos =
  url.indexOf("?key="); 
  if( pos > 0 ){
    var key = url.substring(pos + "?key=".length);
    var prefix = "http://pleiad.dcc.uchile.cl/bibtex/users/all/";
    var obj = $$('a[href="'+prefix+key+'.bib"]');
    if(obj){
      ancestor = obj[0].up(); // DD 
      ancestor.scrollTo();
      ancestor.setStyle({backgroundColor: 'yellow'});
      window.scrollBy(0,-10);
    }
  }
}

function bibtex(key){
     var escapedKey = key.replace(/:/, "-");
     window.location = 'http://pleiad.dcc.uchile.cl/research/publications?key=' + escapedKey;
}
