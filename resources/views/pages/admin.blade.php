@extends('mainpage')
@section('content')
    <div class="container-fluid bigpic">
        <div class="row">
            <div class="col-md-10 mx-auto py-3">
                <h1 class="fw-bold">
                    پنل مدیر سایت:
                </h1>
                <h5>
                    لطفا یکی را انتخاب کنید
                </h5>
            </div>
        </div>
        <div class="row pb-5">
            <div class="row mx-auto">
                <div class="bg-light shadow col  m-3 d-inline-block">
                    <ul class="menu"><span class="fs-4">محصولات:</span>
                        <li>
                            <a href="{{url('/product/add')}}" class="btn btn-outline-warning my-3">
                                اضافه کردن به محصورلات
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/product/list')}}" class="btn btn-outline-warning my-3">
                                لیست محصولات
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bg-light shadow col  m-3 d-inline-block">
                    <ul class="menu"><span class="fs-4">دسته بندی کالاها:</span>
                        <li>
                            <a href="{{url('/categories/create')}}" class="btn btn-outline-warning my-3">
                                اضافه کردن به دسته بندی محصولات
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/categories')}}" class="btn btn-outline-warning my-3">
                                لیست دسته بندی محصولات
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bg-light shadow col  m-3">
                    <ul class="menu"><span class="fs-4">مشخصات محصول ها:</span>
                        <li>
                            <a href="{{url('/properties/create')}}" class="btn btn-outline-warning my-3">
                                اضافه کردن به مشخصات
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/properties')}}" class="btn btn-outline-warning my-3">
                                لیست مشخصات محصول
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="bg-light shadow col m-3">
                    <ul class="menu"><span class="fs-4">رزرو ها:</span>
                        <li>
                            <a href="{{url('/special/list')}}" class="btn btn-outline-warning my-3">
                                لیست رزرو ها
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bg-light shadow col m-3">
                    <ul class="menu"><span class="fs-4">سفارش ها:</span>
                        <li>
                            <a href="{{url('/orders/list')}}" class="btn btn-outline-warning my-3">
                                لیست سفارش ها
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bg-light shadow col m-3">
                    <ul class="menu"><span class="fs-4">کاربر ها:</span>
                        <li>
                            <a href="{{url('/user/list')}}" class="btn btn-outline-warning my-3">
                                لیست کاربرها
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/user/create')}}" class="btn btn-outline-warning my-3">
                                ایجاد کاربر
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

