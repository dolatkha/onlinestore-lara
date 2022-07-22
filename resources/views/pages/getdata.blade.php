{{--@if ($_GET['kalaid'])--}}
{{--    <?php--}}
{{--    $items = \App\Models\Product::all()->where('id', '=', '.'$_GET['kalaid']'.');--}}
{{--    ?>--}}
{{--    @foreach($items as $item)--}}
{{--        <div class="float-start bread-m">--}}
{{--            <div class="card box shadow">--}}
{{--                <div class="card-img pb-5 text-center">--}}
{{--                    <img class="img-fluid" src="image/{{$item->loc}}.jpg">--}}
{{--                </div>--}}
{{--                <div class="card-body text-center p-0">--}}
{{--                    <div class="txtbread1">{{$item->name}}</div>--}}
{{--                    <div class="txtbread2 py-3">{{number_format($item->price,0,'.',',')}}</div>--}}
{{--                </div>--}}
{{--                <div class="card-footer text-center">--}}
{{--                    <div class="btn btn-secondary" onclick="addtobascket({{$item->id}})">اضافه کردن به سبد خرید</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--@endif--}}



@if (isset($_GET['src']))
    <?php
    $products = \App\Models\Product::all()->where('name', '=', '.'$_GET['namesrc']'.');
    ?>
    @foreach($products as $product)
        <div class="col-md-3 float-start bread-m">
            <div class="card box shadow">
                <div class="card-img py-1 text-center">
                    <img class="img-fluid" src="image/'{{$product->loc}}.jpg">
                </div>
                <div class="card-body text-center p-0">
                    <div class="txtbread1">{{$product->name}}</div>
                    ';
                    <div class="txtbread2 py-3">{{$product->loc}} ریال</div>
                </div>
                <div class="card-footer text-center">
                    <div class="btn btn-secondary" onclick="addtobascket({{$product->id}})">اضافه کردن به سبد خرید</div>
                </div>
            </div>
        </div>
    @endforeach
@endif









