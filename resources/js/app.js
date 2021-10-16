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
    }, 15000);
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

    var topMenu = $("#nav-menu"),
        topMenuHeight = $("#nav-menu").outerHeight() + 15,
        menuItems = topMenu.find("a.static-menu"),
        scrollItems = menuItems.map(function() {
            let item = $($(this).attr("href"));
            console.log(item);

            if(item.length) return item;
        });

    $(window).scroll(function () {
        let fromTop = $(this).scrollTop() + topMenuHeight;
        let cur = scrollItems.map(function() {
            if($(this).offset().top < fromTop) return this;
        });
        cur = cur[cur.length - 1];
        let id = cur && cur.length ? cur[0].id : "";
        menuItems
            .parent().removeClass("active neon blue-neon")
            .end().filter('[href="#'+id+'"]').parent().addClass("active neon blue-neon");
    });
}
