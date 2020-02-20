
importScripts('idb.js');
importScripts('utility.js');
var STATIC_FILES=[
    'fb.php',
    'app.js',
    ' http://localhost/favicon.ico',
    'network.png',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
    'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
];
self.addEventListener('install',function(event){
    console.log("install");
    event.waitUntil(
        caches.open('static')
        .then(function(cache){
            cache.addAll([
            'fb.php',
            'app.js',
            ' http://localhost/favicon.ico',
            'network.png',
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js',
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' 
            ]);
        })
    );
});
self.addEventListener('activate',function(event){
    console.log("activated",event);
    return self.clients.claim();
});

function isInArray(string,array){
    for(var i=0;i<array.length;i++){
        if(string.endsWith(array[i])){
            return true;
        }}
        return false;
    }
self.addEventListener('fetch',function(event){
    var URL="postsindexed.php";
    if(event.request.url.indexOf(URL)>-1){
        event.respondWith(
              /*(function (){
                  console.log('i got executed');
                var xhttp=new XMLHttpRequest();
                    xhttp.onreadystatechange=function(){
                    if(this.readyState==4 && this.status==200){
                            var c=this.responseText;
                            var cp=JSON.parse(c);
                            console.log('parsed :',cp);
                           for(data of cp){
                               writeData('posts',cp[data]);
                           }
                        }
                    };
                   xhttp.open("GET","postsindexed.php",true);xhttp.send();
                   return c;
            })() */
            fetch(event.request)
            .then(function(res){
                var clonedRes=res.clone();
              //  var c=JSON.parse(res);
               // console.log('fetch:',res);
               /* for(data of c){
                    writeData('posts',c[data]);
                } */
              //  return res;
              clearAlldata('posts');
              clonedRes.json()
            .then(function(res){
                console.log('fetchfrom serviceworker:',res);
                for(var data of res){
                    writeData('posts',data);
            }
        }
            )
            .catch(function(err){
                console.log('error',err)
            })
            return res;
        })
        )
    }
    else if(isInArray(event.request.url,STATIC_FILES)){
        console.log('static files...')
        event.respondWith(caches.match(event.request));
    }

});