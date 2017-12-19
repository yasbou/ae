var services = document.querySelectorAll('.service');

services.forEach(function(service, index){
    timeout= 300 * index;
setTimeout(function () {
    service.style.display = 'inline';
}, timeout);
})
