var deferredPrompt;
if('serviceWorker' in navigator){
    navigator.serviceWorker.register('/phplearning/facebook/sw.js');
}
window.addEventListener('beforeinstallprompt',function(event){
    event.preventDefault();
    deferredPrompt=event;
    return false;
})