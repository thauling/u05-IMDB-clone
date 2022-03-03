require('./bootstrap');

import Alpine from 'alpinejs';
import { appendChild } from 'domutils';

window.Alpine = Alpine;

Alpine.start();

let preview = document.getElementById('preview');

if (preview.src === "(unknown)") {
    preview.style.display = 'none';
}






