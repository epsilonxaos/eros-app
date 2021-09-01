/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

document.getElementById('btn-menu-movil').addEventListener('click', function(){
    let sidebar = document.querySelector('.nav-sidebar');

    this.classList.toggle('active');
    sidebar.classList.toggle('active');
});

document.addEventListener("DOMContentLoaded", function(){
    setTimeout(() => {
        $('.loading').fadeOut();
    }, 1500);
});

if(document.querySelector('.move-animation')){
    document.querySelectorAll('.move-animation a').forEach(element => {
        element.addEventListener('click', () => {
            let id = element.dataset.id;
            let space = element.dataset.space;
            let speed = element.dataset.speed;

            console.log(id, space, speed);

            var body = $('html, body');
            var target = $(id);

            console.log(target);

            body.animate({
                scrollTop: target.offset().top - space
            }, speed);
        });
    });
}
