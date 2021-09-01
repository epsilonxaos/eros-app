import Swiper from 'swiper';
import SwiperCore, { Navigation, Thumbs, EffectFade } from 'swiper/core';

SwiperCore.use([Navigation, Thumbs, EffectFade]);

var galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    slidesPerColumnFill: 'row'
});

var galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    slidesPerColumnFill: 'row',
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    thumbs: {
        swiper: galleryThumbs
    }
});
