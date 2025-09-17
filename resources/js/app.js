import './bootstrap';
import './echo';
import Alpine from 'alpinejs';

import Swiper, { Navigation, Pagination, Autoplay } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

window.Alpine = Alpine;
Alpine.start();

// Initialize Swiper when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.mySwiper', {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        speed: 800, // smoother transition
        grabCursor: true, // makes it draggable
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true, // modern pagination style
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
