@extends('mainpage')
@section('content')
    <?php
    $userId=\Illuminate\Support\Facades\Auth::id();
    ?>
    <div class="container-fluid bigpic">
        <div class="row">
            <div class="col-md-10 col-12 mx-auto text-center mb-md-5" >
                @foreach($cakes as $cake)
                    <div class="float-start bread-m">
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
        </div>
    </div>
@endsection

