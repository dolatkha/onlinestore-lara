<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUN YUM</title>
    <link rel="icon" type="image/x-icon" href="{{url('image/favicon.ico')}}">
    <script src="{{url('js/swiper-bundle.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{url('css/swiper-bundle.min.css')}}">
    <script language="JavaScript" type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
    <script src="{{url('js/bootstrap.bundle.min.js')}}" language="JavaScript" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{url('css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/animated.css')}}">
    <script language="JavaScript" type="text/javascript" src="{{url('js/wow.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/brands.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
    <script language="JavaScript" type="text/javascript" src="{{url('js/myjs.js')}}"></script>
    @yield('head')
</head>
<body id="body">
<?php
$userId=\Illuminate\Support\Facades\Auth::id();
?>
<div class="container-fluid top-header bglink py-3 animate__animated animate__fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-4">
                <form action="{{route('logout')}}" method="post" class="
                     @if(!\Illuminate\Support\Facades\Auth::check())
                    {{'d-none'}}
                    @else
                    {{''}}
                    @endif
                    ">
                    @csrf
                    <button class="btn btn-outline-danger rounded-circle">
                        <i class="fa fa-power-off "></i>
                    </button>
                </form>
                <a href="{{url('/login')}}" class="text-decoration-none text-primary
                    @if(\Illuminate\Support\Facades\Auth::check())
                    {{'d-none'}}
                    @else
                    {{''}}
                    @endif
                ">ورود کاربر</a>

            </div>
            <div class="col-md-4 col-8 text-end text-primary wow zoomIn" data-wow-duration="3s">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <h4>
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </h4>
                @else
                    {{'به نانوایی آنلاین YUM YUM خوش آمدید.'}}
                @endif
            </div>
            <div class="col-md-4 col-12">
                <input type="text" class="py-2 border-0" placeholder="جستجو.." onkeyup="mysearch(event)">
            </div>
            <div class="col-md-2 d-md-block d-none">
                ساعت کار:۸ صبح تا ۲۲ شب
            </div>
        </div>
    </div>
</div>
<div class="container d-none" id="searchid">
    <script>
        $(document).ready(function () {
            mysearch = function (e) {
                document.getElementById('searchid').classList.remove('d-none');
                src=e.target.value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax('{{url('product/search')}}',
                    {
                        dataType: 'json',
                        data: {'search':src},
                        method:'get',
                        beforeSend:function (data, status, xhr){
                            $('#showsearch').html('<div class="spinner-border border-success"></div><sapn class="text-white">لطقا منتظر باشید</span>');
                        },
                        success: function (data, status, xhr) {   // success callback function
                            var content='';
                            for(item of data){
                                content=content+'<div class="col-md-3 float-start bread-m">'+
                                    '<div class="card box shadow">'+
                                    '<div class="card-img py-1 text-center">'+
                                    '<img class="img-fluid" src="image/' +item.loc+ '.jpg' + '">'+
                                    '</div>'+
                                    '<div class="card-body text-center p-0">'+
                                    '<div class="txtbread1">' +item.name+'</div>'+
                                    '<div class="txtbread2 py-3" >'  +item.price+ ' ریال' + '</div>'+
                                    '</div>'+
                                    '<div class="card-footer text-center">'+
                                    '<button class="btn btn-secondary" onclick="addtobascket(item.id,{{$userId}})">اضافه کردن به سبد خرید</button>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>';
                            }
                            $('#showsearch').html(content);
                        },
                        error: function (jqXhr, textStatus, errorMessage) { // error callback
                            $('#showsearch').html(errorMessage);
                        }
                    });
            }
        })

    </script>
    <div class="row">
        <button class="btn btn-danger rounded-circle closebtnsearch" id="closeid" onclick="closepic()">&times;</button>
        <div class="col-md-10 col-12 divsrc" id="showsearch"></div>
    </div>
</div>
<div class="container-fluid header shadow animate__animated animate__fadeInDown">
    <div class="row">
        <div class="col-md-2 col-10 text-start buy mt-md-3 cart-m user">
            <span class="badge bg-danger mx-2 fa-1x" id="badgeid">

            </span><i class="fa fa-shopping-cart fa-3x"data-bs-toggle="modal" data-bs-target="#myModal"></i>
        </div>
        <div class="col-2 btn navbtn d-md-none" onclick="show()"><i class="fa fa-bars"></i></div>
        <div class="col-md-7">
            <nav class="navitem d-none d-md-block" id="menuid">
                <ul class="casecademenu">
                    <li><a href="{{url('firstpage')}}" {{ request()->is('*firstpage*') ? 'class=active' : '' }}>خانه</a></li>
                    <li><a>محصولات</a>
                        <ul>
                            <li><a href="{{url('bread')}}" {{ request()->is('*bread*') ? 'class=active' : '' }}>نان</a></li>
                            <li><a href="{{url('cake')}}" {{ request()->is('*cake*') ? 'class=active' : '' }}>کیک</a></li>
                            <li><a href="{{url('food')}}" {{ request()->is('*food*') ? 'class=active' : '' }}>غذا</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('gallery')}}" {{ request()->is('*gallery*') ? 'class=active' : '' }}>گالری</a></li>
                    <li><a href="{{url('firstpage')}}#about" >درباره ما</a></li>
                    <li><a href="#contact">تماس با ما</a></li>
                    <li class="
                         @if(\Illuminate\Support\Facades\Auth::id()==4)
                        {{''}}
                        @else
                        {{'d-none'}}
                        @endif
                    "><a href="{{url('admin')}}" {{ request()->is('*admin*') ? 'class=active' : '' }}>مدیر سایت</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-md-3 col-8 logo-m">
            <div class="logo text-start ms-5">
                <a href="#"><img src="{{url('image/logo.png')}}" class="img-fluid"></a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        @yield('product')
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">سبد خرید</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body col-12 " id="sabad">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a name="contact"></a>
<div class="container-fluid bgcontact">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="txtcontact3">
                <h3 class="text-center">تماس با ما</h3>
                <div class="pb-4">
                    آدرس:میدان هنرستان
                    <br>
                    ایمیل:dolatkhah_l@yahoo.com
                </div>
                <div>
                    تلفن: 09154421736 <br>
                    واتس آپ: 09154421736
                </div>
                <div class="py-4">
                    ایمیل:dolatkhah_l@yahoo.com
                </div>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="linedivid"></div>
            <div>
                <h3 class="text-center txtcontact2">خدمات</h3>
                <ul class="list-unstyled ulcontact">
                    <li class="s"><a href="{{url('bread')}}" class="text-decoration-none txtcontactlink">نان</a></li>
                    <li class="s"><a href="{{url('cake')}}" class="text-decoration-none txtcontactlink">کیک</a></li>
                    <li class="s"><a href="{{url('food')}}" class="text-decoration-none txtcontactlink">غذا</a></li>
                    <li class="s"><a href="" class="text-decoration-none txtcontactlink"> دسر</a></li>
                    <li class="s"><a href="" class="text-decoration-none txtcontactlink"> بزودی</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="linedivid"></div>
            <div class="logo text-start ms-5">
                <a href="#"><img src="{{url('image/logo4-2.png')}}" class="img-fluid"></a>
            </div>
            <div class="text-start ms-md-5">
                <a href="http://www.youtub.com"> <img src="{{url('image/youtub.png')}}" class="ms-3 wow fadeInDown"
                                                      data-wow-duration="2s" data-wow-delay="3s"></a>
                <a href="http://www.instagram.com"><img src="{{url('image/insta.png')}}" class="wow fadeInDown"
                                                        data-wow-duration="2s" data-wow-delay="2s"></a>
                <a href="http://www.twiter.com"><img src="{{url('image/twitter.png')}}" class="mx-3 wow fadeInDown"
                                                     data-wow-duration="2s" data-wow-delay="1s"></a>
                <a href="http://www.facebook.com"><img src="{{url('image/facebook.png')}}" class="ms-5 wow fadeInDown"
                                                       data-wow-duration="2s"></a>
            </div>
            <div class="txtcontact text-center">
                در خبرنامه ما ثبت نام کنید تا از تبلیغات، تخفیف ها، فروش ها و پیشنهادات ویژه ما به روز بمانید.
            </div>
            <div class="txtemail mb-5 col-md-7 col-8">
                <input type="email" placeholder="ایمیل خود را وارد نمائید"
                       class="form-control border-0 py-2 mb-2 text-center bg-transparent">
                <div class="btn mybtn3">ثبت نام</div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center text-white mx-auto  footer py-3">
            .SONBOL Bakery © {{date('Y')}}. All Rights Reserved
        </div>
    </div>
</div>
</body>
</html>

