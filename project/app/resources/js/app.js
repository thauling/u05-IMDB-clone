require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.onload=fadeout;
           
function fadeout() {
    
    
    let fade= document.getElementById("status");
      
    let intervalID = setInterval(function () {
          
        if (!fade.style.opacity) {
            fade.style.opacity = 1;
        }
          
          
        if (fade.style.opacity > 0) {
            fade.style.opacity -= 0.1;
        } else {
            clearInterval(intervalID);
        }
          
    }, 200);
}