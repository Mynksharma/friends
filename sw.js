importScripts('/phplearning/facebook/idb.js');
importScripts('/phplearning/facebook/utility.js');
var STATIC_FILES=[
    '/phplearning/facebook/fb.php',
    '/phplearning/facebook/app.js',
    '/phplearning/facebook/network.png',
    '/phplearning/facebook/sidebar.php',
    '/phplearning/facebook/idb.js',
    '/phplearning/facebook/utility.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
    'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
    ];
var CACHE_DYNAMIC_NAME='dynamic';
self.addEventListener('install',function(event){
    console.log("install");
    event.waitUntil(
        caches.open('static')
        .then(function(cache){
            cache.addAll([
            '/phplearning/facebook/fb.php',
            '/phplearning/facebook/app.js',
            '/phplearning/facebook/network.png',
            '/phplearning/facebook/sidebar.php',
            '/phplearning/facebook/idb.js',
            '/phplearning/facebook/utility.js',
            '/phplearning/facebook/offline.html',
            '/phplearning/facebook/static_images/astro.png',
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
    var URL2='logout.php';
    var URL3=['login_sub.php','/phplearning/facebook/online.php'];
    var URL4='/phplearning/facebook/main.php';
    if(event.request.url.indexOf(URL4)>-1){
        event.respondWith(
            fetch(event.request)
            .then(function(res){
                return caches.open(CACHE_DYNAMIC_NAME)
                .then(function(cache){
                    cache.put(event.request.url,res.clone());
                    return res;
                })
            })
            .catch(function(err){
                return caches.match(event.request);
            })
        )
    } 
    else if(event.request.url.indexOf(URL2)>-1){
        event.waitUntil(
            caches.keys()
            .then(function(keylist){
                return Promise.all(keylist.map(function(key){
                    if(key==CACHE_DYNAMIC_NAME){
                        return caches.delete(key);
                    }
                }))
            })
        )
    } 
    else if(event.request.url.indexOf(URL)>-1){
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
    else{
        if(!(URL3.find(x => event.request.url.indexOf(x)>-1))){
        event.respondWith(
            caches.match(event.request)
            .then(function(response){
                if(response){
                    return response;
                }
                else{
                    return fetch(event.request)
                    .then(function(res){
                        return caches.open(CACHE_DYNAMIC_NAME)
                        .then(function(cache){
                    cache.put(event.request.url,res.clone());
                    return res;
                        })
                    })
                }
            })
        )
        }
    }

});
self.addEventListener('sync',function(event){
    console.log('[Service worker] Background syncing',event);
    if(event.tag==='sync-new-posts'){
        console.log('[Service worker] Syncing new posts...');
        event.waitUntil(
            readAllData('sync-posts')
            .then(function(data){
                for(let item of data){
                  fetch('/phplearning/facebook/post.php?status='+item.p)
                  .then(function(res){
                    if(res.ok){
                        deleteItemFromData('sync-posts',item.id);
                        clients.matchAll()
                        .then(function(clis){
                            var client=clis.find(function(c){
                                return c.visibilityState='visible';
                            });
                            if(client!=undefined){
                                client.navigate('/phplearning/facebook/main.php');
                            }
                        })
                    }
                  }
                  )
                }
            })
        )
    }
    }
    )