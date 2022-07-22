@extends('productmainpage')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('css/jalalidatepicker.min.css')}}" />
    <script type="text/javascript" src="{{url('js/jalalidatepicker.min.js')}}"></script>
@endsection
@section('product')
    <div class="container-fluid bigpic">
        <div class="row">
            <div class="col-md-8 col-12 mx-auto" id="foodid">
                @if($msg)
                    {!! $msg !!}
                @endif

                <form class="form-control my-5 shadow" action="{{url(\Illuminate\Support\Facades\Auth::id().'/special/add')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::id()}}" name="user_id">
                    <label class="form-label pt-3">
                        نوع مراسم:
                    </label>
                    <div class="form-check d-inline pt-3">
                        <div class="form-check d-inline-block">
                            <input type="radio" class="form-check-input" value="0" name="mehmani">
                            <label class="form-check-label">دو نفره</label>
                        </div>
                        <div class="form-check d-inline-block">
                            <input type="radio" class="form-check-input" value="1" name="mehmani">
                            <label class="form-check-label">دورهمی</label>
                        </div>
                        <div class="form-check d-inline-block">
                            <input type="radio" class="form-check-input" value="2" name="mehmani">
                            <label class="form-check-label">تولد</label>
                        </div>
                        <div class="form-check d-inline-block">
                            <input type="radio" class="form-check-input" value="3" name="mehmani">
                            <label class="form-check-label">عروسی</label>
                        </div>
                    </div>
                    @error('mehmani')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label pt-3">
                        تعداد مهمان:
                    </label>
                    <input class="form-control w-25 tedad d-inline-block" type="number" name="tedad" min="0"
                           placeholder="0">نفر 
                    @error('tedad')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label pt-3">
                        تاریخ رزرو :
                    </label>
                    <input type="text" data-jdp class="form-control d-inline" name="date" value="{{isset($predit->date)?verta($predit->date)->format('Y/m/d'):''}}" placeholder="1401/02/10">
                    @error('date')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label pt-3">
                        نوع پذبرایی:
                    </label>
                    <div class="table-responsive  text-center">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>پیش غذا</th>
                                    <th>غذا اصلی</th>
                                    <th>دسر</th>
                                    <th>نوشیدنی</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="card">
                                        <div class="card-img"><img src="{{url('image/food1.jpg')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="ash" value="1">
                                        </div>
                                        <div class="card-footer">آش</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/food4.jpg')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="ghorme" value="1">
                                        </div>
                                        <div class="card-footer">قرمه سبزی</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="bastani" value="1">
                                        </div>
                                        <div class="card-footer">بستنی</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="ab" value="1">
                                        </div>
                                        <div class="card-footer">آب</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="kashk" value="1">
                                        </div>
                                        <div class="card-footer">کشک بادمجان</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="kabab" value="1">
                                        </div>
                                        <div class="card-footer">چلو کباب</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="jelle" value="1">
                                        </div>
                                        <div class="card-footer">زله</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="dough" value="1">
                                        </div>
                                        <div class="card-footer">دوغ</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="dolme" value="1">
                                        </div>
                                        <div class="card-footer">دلمه</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="gosht" value="1">
                                        </div>
                                        <div class="card-footer">چلو گوشت</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="poding" value="1">
                                        </div>
                                        <div class="card-footer">پودینگ</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="noshabeh" value="1">
                                        </div>
                                        <div class="card-footer">نوشابه</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="mazeh" value="1">
                                        </div>
                                        <div class="card-footer">سینی مزه</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="koofteh" value="1">
                                        </div>
                                        <div class="card-footer">کوفته</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="shaik" value="1">
                                        </div>
                                        <div class="card-footer">شیک</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{url('image/twiter.png')}}" class="w-50 img-fluid"></div>
                                        <div class="card-body">
                                            <input type="number" name="delester" value="1">
                                        </div>
                                        <div class="card-footer">دلستر</div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="submit" value="ارسال" class="btn btn-success my-4 sabt">
                </form>
            </div>
        </div>
    </div>
    <script>
        jalaliDatepicker.startWatch();
    </script>
@endsection
