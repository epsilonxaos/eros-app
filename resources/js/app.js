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

    $(document).on("click",function(e) {

        var container = $("#menu--list");
        var container2 = $("#btn-menu-movil");

        //    if ((!container.is(e.target) && container.has(e.target).length === 0) && (!container2.is(e.target) && container2.has(e.target).length === 0)) {
           if (!container2.is(e.target) && container2.has(e.target).length === 0) {
              console.log("¡Pulsaste fuera!");
              document.getElementById('btn-menu-movil').classList.remove('active');
              document.querySelector('.nav-sidebar').classList.remove('active');
            //   document.querySelector('body').classList.remove('active-menu');
           }
    });
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
