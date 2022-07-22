$(document).ready(function (){
    $("a:not([href])").click(function (){
        event.preventDefault();
        event.stopPropagation();
        all=$('.casecademenu ul');
        prnt=$(this).parentsUntil(' ul.casecademenu');
        th=$(this).next();
        prnt.push(th[0]);
        for (i=0;i<all.length;i++){
            found=false;
            for (j=0;j<prnt.length;j++){
                if (all[i]==prnt[j]){
                    found=true;
                }
            }
            if (found==false){
                $(all[i]).slideUp();
            }
        }
        $(this).next().slideToggle('slow');
    });

    $(".txt").fadeOut(3000);

    show=function (){
        document.getElementById('menuid').classList.toggle('d-none');
    };
    //baraye bastan panjareh search
    closepic=function () {
        document.getElementById('searchid').classList.add('d-none');
        document.getElementById('showsearch').innerHTML=" ";
    };

var swiper = new Swiper(".swiper1", {
    spaceBetween: 30,
    centeredSlides: true,
    effect: "fade",
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".swiperbread", {
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 10
        },
        800:{
            slidesPerView: 3,
            spaceBetween: 30
        }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".swipercake", {
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 10
        },
        800:{
            slidesPerView: 3,
            spaceBetween: 30
        }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".swiperfood", {
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 10
        },
        800:{
            slidesPerView: 3,
            spaceBetween: 30
        }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

new WOW().init();

//baraie makhfi kardan pigham exit
    $('#exit').hide(4000);
//baraie etminan az ersal be db
    checksend= (e)=>{
        if (confirm("آیا از خرید خود اظمینان دارید؟")){
            return true;
        }
        else {
            e.preventDefault();
            return false;
        }
    }

});


