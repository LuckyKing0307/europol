// resources/js/app.js
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'nouislider/dist/nouislider.css';

import Swiper from 'swiper/bundle';
import noUiSlider from 'nouislider';
import BeerSlider from 'beerslider';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

window.Swiper = Swiper;
window.noUiSlider = noUiSlider;
window.BeerSlider = BeerSlider;

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

