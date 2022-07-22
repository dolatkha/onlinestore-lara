@extends('mainpage')
@section('content')
    <a name="firstpage"></a>
    <div class="container-fluid pb-5  p-0 overflow-hidden">
        <div class="row">
            <div class="swiper swiper1">
                <div class="text-primary txt">تجربه تازه از مزه ها..</div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="{{url('image/home1.jpg')}}" class="w-100  d-block"></div>
                    <div class="swiper-slide"><img src="{{url('image/home3.jpg')}}" class="w-100  d-block"></div>
                    <div class="swiper-slide"><img src="{{url('image/home4.jpg')}}" class="w-100  d-block"></div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <a name="product"></a>
    <?php
    $userId=\Illuminate\Support\Facades\Auth::id();
    ?>
    <div class="container-fluid bgabout my-5 shadow-lg">
        <div class="row">
            <div class="col-md-8 col-12 swiper swiperbread">
                <div class="swiper-wrapper">
                    <?php
                    $breads = \App\Models\Product::all()->where('category_id', '=', '1')
                    ?>
                    @foreach($breads as $bread)
                        <div class="swiper-slide col-4 wow slideInRight" data-wow-duration="4s">
                            <div class="card box shadow">
                                <div class="card-img pb-5 text-center">
                                    <img class="img-fluid" src="image/{{$bread->loc}}.jpg">
                                </div>
                                <div class="card-body text-center p-0">
                                    <div class="txtbread1">{{$bread->name}}</div>
                                    <div class="txtbread2 py-3">{{number_format($bread->price,0,'.',',')}} ریال</div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-secondary" onclick="addtobascket({{$bread->id}},{{$userId}})">اضافه کردن به سبد خرید</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="col-md-4 col-12 d-none d-md-block text-center bread">
                <div class="text-light txtbread">
                    نان ها
                </div>
                <div class="btn btn-warning mybtn2">
                    <a href="{{'/bread'}}" class="text-decoration-none text-white p-3"> تمام محصولات</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-4 col-12 d-none d-md-block text-center cake">
                <div class="text-light txtbread">
                    کیک ها
                </div>
                <div class="btn btn-warning  mybtn2">
                    <a href="{{'/cake'}}" class="text-decoration-none text-white p-3"> تمام محصولات</a>
                </div>
            </div>
            <div class="col-md-8 col-12 swiper swipercake">
                <div class="swiper-wrapper">
                    <?php
                    $cakes = \App\Models\Product::all()->where('category_id', '=', '2')
                    ?>
                    @foreach($cakes as $cake)
                        <div class="swiper-slide col-4 wow slideInRight" data-wow-duration="4s">
                            <div class="card box shadow">
                                <div class="card-img pb-5 text-center">
                                    <img class="img-fluid" src="image/{{$cake->loc}}.jpg">
                                </div>
                                <div class="card-body text-center p-0">
                                    <div class="txtbread1">{{$cake->name}}</div>
                                    <div class="txtbread2 py-3">{{number_format($cake->price,0,'.',',')}} ریال</div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-secondary" onclick="addtobascket({{$cake->id}},{{$userId}})">اضافه کردن به سبد خرید</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid my-5 bgabout shadow-lg">
        <div class="row">
            <div class="col-md-8 col-12 swiper swiperfood">
                <div class="swiper-wrapper">
                    <?php
                    $foods = \App\Models\Product::all()->where('category_id', '=', '3')
                    ?>
                    @foreach($foods as $food)
                        <div class="swiper-slide col-4 wow slideInRight" data-wow-duration="4s">
                            <div class="card box shadow">
                                <div class="card-img pb-5 text-center">
                                    <img class="img-fluid" src="image/{{$food->loc}}.jpg">
                                </div>
                                <div class="card-body text-center p-0">
                                    <div class="txtbread1">{{$food->name}}</div>
                                    <div class="txtbread2 py-3">{{number_format($food->price,0,'.',',')}} ریال</div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-secondary" onclick="addtobascket({{$food->id}},{{$userId}})">اضافه کردن به سبد خرید</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="col-md-4 col-12 d-none d-md-block text-center food">
                <div class="text-light txtbread">
                    غذا ها
                </div>
                <div class="btn btn-warning  mybtn2">
                    <a href="{{url('/food')}}" class="text-decoration-none text-white p-3"> تمام محصولات</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid special">
        <div class="row bgoverspecial">
            <div class="col-md-4 col-8 mx-auto text-center wow fadeInDown" data-wow-duration="3s">
                <div class="text-light txtbread">
                    خدمات ویژه
                </div>
                <div class="btn btn-warning rounded-pill  mybtn2">
                    <a href="{{url('/special')}}" class="text-decoration-none text-white p-2"> الان سفارش دهید</a>
                </div>
            </div>
        </div>
    </div>
    <a name="about"></a>
    <div class="container my-5">
        <div class="row mx-auto">
            <div class="col-md-1 d-none d-md-block"></div>
            <div class="col-md-3 col-12 card text-center my-3 shadow">
                <div class="txtbread3 pt-5">
                    می توانید نان مورد علاقه خود<br> را سفارش دهید
                </div>
                <div class="txtbread3 py-5">
                    در اینجا نان، کلوچه، کیک، شیرینی و پای مورد علاقه خود را پیدا خواهید کرد.
                </div>
                <a href="bread.htm" class="text-decoration-none text-white">
                    <div class="btn mybtn2 w-50 rounded-pill align-self-center mb-5"> بیشتر</div>
                </a>
            </div>
            <div class="col-md-3 col-12 card text-center mx-md-5 my-3 shadow">
                <div class="txtbread4 pt-5">
                    خوشمزه ترین چیزکیک ها، کلوچه های فوق العاده
                </div>
                <div class="txtbread4 py-5">
                    با برداشتن کیک خود از فروشگاه ما،می توانید یک نانوایی یا شیرینی شخصی تهیه کنید.
                </div>
                <a href="cake.htm" class="text-decoration-none text-white">
                    <div class="btn mybtn2 w-50 rounded-pill align-self-center mb-5">بیشتر</div>
                </a>
            </div>
            <div class="col-md-3 col-12 card text-center my-3 shadow">
                <div class="txtbread3 pt-5">
                    می توانید غذا مورد علاقه خود را سفارش دهید و از آن لذت ببرید
                </div>
                <div class="txtbread3 py-5">
                    در اینجا کوفته، آش و خیلی از غذا های مورد علاقه خود را پیدا خواهید کرد.
                </div>
                <a href="food.htm" class="text-decoration-none text-white">
                    <div class="btn mybtn2 w-50 rounded-pill align-self-center mb-5"> بیشتر</div>
                </a>
            </div>
            <div class="col-md-1 d-none d-md-block"></div>
        </div>
    </div>
    <div class="container-fluid bgabout shadow-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-8 mx-auto px-md-1 px-0">
                    <div class="txtinfo shadow text-center">
                        برگشت پول در صورت عدم رضایت از کیفیت
                    </div>
                    <div class="bginfo wow fadeInDownBig" data-wow-duration="2s">
                        <img src="image/tel.png" class="imginfo">
                    </div>
                </div>
                <div class="col-md-4 col-8 mx-auto px-md-1 px-0">
                    <div class="txtinfo shadow text-center">
                        ارسال رایگان برای سفارشات بالای 100.000 تومان
                    </div>
                    <div class="bginfo wow fadeInDownBig" data-wow-duration="2s">
                        <img src="image/deliver.png" class="imginfo">
                    </div>
                </div>
                <div class="col-md-4 col-8 mx-auto px-md-1 px-0">
                    <div class="txtinfo shadow text-center">
                        09154421736<br>
                        خط تلفن رایگان شبانه روزی
                    </div>
                    <div class="bginfo wow fadeInDownBig" data-wow-duration="2s">
                        <img src="image/price.png" class="imginfo">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
