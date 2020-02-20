var deferredPrompt;
if('serviceWorker' in navigator){
    navigator.serviceWorker.register('sw.js');
}
window.addEventListener('beforeinstallprompt',function(event){
   
    event.preventDefault();
    deferredPrompt=event;
    return false;
})