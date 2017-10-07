(function(){
    var request = window.indexedDB.open("ISLDB",3);

    request.onsuccess = function(e) {
      console.log('ISLDB : OK');
      db = e.target.result;
    }

    request.onerror = function(e) {
      console.log("ISLDB : Error");
      console.log(e);
    }

    request.onupgradeneeded = function(e) {
      var db = e.target.result;

      if(!db.objectStoreNames.contains('cfiles')) {
        var os = db.createObjectStore('cfiles',{keyPath:"fileurl"});
      }
    }

})();

function addToCache(fileurl, data) {
  
}