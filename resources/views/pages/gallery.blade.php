@extends('mainpage')
@section('content')
    <div class="container-fluid bggallery" id="heght">
        <div class="row d-none" id="showbig">
            <div class="col-md-6 col-12 mx-md-auto" id="bigpic">
            </div>
            <div class="btn btn-outline-primary rounded-circle left-gallery" id="leftarrow" onclick="changepic(1)"><i class="fa fa-chevron-left"></i></div>
            <div class="btn btn-outline-primary rounded-circle right-gallery" id="rightarrow" onclick="changepic(2)"><i class="fa fa-chevron-right"></i></div>
            <div class="btn btn-outline-warning rounded-circle zoom-in" id="zoomin" onclick="zoom(1)"><i class="fa fa-search-plus"></i> </div>
            <div class="btn btn-outline-warning rounded-circle zoom-out" id="zoomout" onclick="zoom(2)"><i class="fa fa-search-minus"></i> </div>
            <div class="btn btn-danger rounded-circle closebtngallery close" onclick="closepicgallery()">&times;</div>
        </div>
        <div class="row">
            <div class="swiper mySwipersmallpic">
                <div class="swiper-wrapper col-3" id="smallpic">

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <script>
        images=[
            {
                tinyimg:"pic1.jpg",
                largimg:"pic1big.jpg",
                txt:"toyota"
            },
            {
                tinyimg:"pic2.jpg",
                largimg:"pic2big.jpg",
                txt:"mazda"
            },
            {
                tinyimg:"pic3.jpg",
                largimg:"pic3big.jpg",
                txt:"honda"
            },
            {
                tinyimg:"pic4.jpg",
                largimg:"pic4big.jpg",
                txt:"benz"
            },
            {
                tinyimg:"pic5.jpg",
                largimg:"pic5big.jpg",
                txt:"bmw"
            },
            {
                tinyimg:"pic6.jpg",
                largimg:"pic6big.jpg",
                txt:"ferrari"
            },
            {
                tinyimg:"pic7.jpg",
                largimg:"pic7big.jpg",
                txt:"alfa"
            },
            {
                tinyimg:"pic8.jpg",
                largimg:"pic8big.jpg",
                txt:"wolks"
            },
            {
                tinyimg:"pic9.jpg",
                largimg:"pic9big.jpg",
                txt:"alfa"
            },
            {
                tinyimg:"pic10.jpg",
                largimg:"pic10big.jpg",
                txt:"wolks"
            }
        ];

        function showpic(value,index,array){
            document.getElementById('smallpic').innerHTML=document.getElementById('smallpic').innerHTML+' <div class="swiper-slide">'+'<img class="img-fluid " src="image/bigimage/'+value.tinyimg+'" onclick="showgallery('+index+')">'+'</div>';
        }
        images.forEach(showpic);

        active=0;
        st=-1;
        si=-1;
        width=0;
        function showgallery(indeximage){
            document.getElementById('showbig').classList.remove('d-none');
            document.getElementById('heght').style.height='100%';
            document.getElementById('bigpic').innerHTML='<img class="img-fluid m-md-2" src="image/bigimage/'+images[indeximage].largimg+'">';
            active=indeximage;
            st=setTimeout('autoshow()',3000);
            si=setInterval('changeprogress()',30);
        }


        var swiper = new Swiper(".mySwipersmallpic", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });

        changepic=function (dir){
            if (st!=1){
                clearTimeout(st);
                clearInterval(si);
                width=0;
            }
            if (dir==1){
                active--;
                if (active<0){
                    active=7;
                }
            }
            else {
                active++;
                if (active>7){
                    active=0;
                }
            }
            showgallery(active);
        };

        autoshow=function (){
            changepic(2);
        };

        closepicgallery=function (){
            document.getElementById('showbig').classList.add('d-none');
            document.getElementById('heght').style.height='72vh';
            clearTimeout(st);
            if (x!=1){
                document.getElementById('bigpic').innerHTML=document.getElementById('bigpic').style.transform=('scale(1,1)');
            }
        };
        x=1;
        y=1;
        zoom=function (dir){
            if (dir==1){
                x=x+0.5;
                y=y+0.5;
                document.getElementById('bigpic').style.transform=('scale('+x+','+y+')');
                clearTimeout(st);
            }
            else {
                x=x-0.5;
                y=y-0.5;
                document.getElementById('bigpic').style.transform=('scale('+x+','+y+')');
                clearTimeout(st);
            }
        }
    </script>
@endsection
