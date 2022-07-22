@extends('productmainpage')
@section('product')
    <div class="table-responsive mt-5 px-5">
        @if($msg)
            {!! $msg !!}
        @endif
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>شناسه</th>
                <th>تصویرکالا</th>
                <th>نام کالا</th>
                <th>قیمت</th>
                <th>تعداد</th>
                <th>وضعیت</th>
                <th>عنوان</th>
                <th>تاریخ ایجاد</th>
                <th>تاریخ ثبت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $pr)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pr->id}}</td>
                    <td><img src="{{url('image/'.$pr->loc)}}.jpg"width="50px"></td>
                    <td>{{$pr->name}}</td>
                    <td>{{number_format($pr->price,0,'.',',')}}</td>
                    <td>
                        @if($pr->count==0 || !$pr->count)
                            اتمام موجودی
                        @else
                            {{$pr->count}}
                        @endif
                    </td>
                    <td>
                        @if($pr->status==1)
                            <span class="rounded-pill bg-success text-white p-1">فعال</span>
                        @else
                            <span class="rounded-pill bg-danger text-white p-1">غیرفعال</span>
                        @endif
                    </td>
                    <td>
                        @if($pr->category_id==1)
                            نان
                        @elseif($pr->category_id==2)
                        کیک
                        @elseif($pr->category_id==3)
                        غذا
                        @endif
                    </td>
                    <td>{{$pr->start_date?verta($pr->start_date)->format('Y/m/d'):'---'}}</td>
                    <td>{{verta($pr->created_at)->format('Y/m/d')}}</td>
                    <td>
                        <a href="{{url('product/property/'.$pr->id)}}" class="btn btn-outline-secondary" title="افزودن مشخصه"><i class="fa fa-link"></i> </a>
                        <a href="{{url('product/edit/'.$pr->id)}}" class="btn btn-outline-info" title="ویرایش"><i class="fa fa-edit"></i> </a>
                        <form method="post" action="{{url('/product/list')}}" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{$pr->id}}" name="row">
                            <button class="btn btn-danger" type="submit" title="حذف" onclick="confirmdelete(event)"><i class="fa fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center col-md-3 mb-5 mt-3 col-12">
        <div class="text-center">
            <a class=" btn btn-warning
                @if($products->currentPage()<=1)
                    disabled
                    @endif
            " href="{{url()->current().'?page='.($products->currentPage()-1)}}">قبلی</a>
            @if($products->currentPage()>=2)
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($products->currentPage()-1)}}">{{$products->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled" href="{{url()->current().'?page='.($products->currentPage()-1)}}">{{$products->currentPage()}}</a>
            @if($products->lastPage()>$products->currentPage())
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($products->currentPage()+1)}}">{{$products->currentPage()+1}}</a>
            @endif
            @if($products->lastPage()>$products->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                @if($products->lastPage()==$products->currentPage())
                disabled
                @endif
            " href="{{url()->current().'?page='.($products->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
               تعداد کل رکوردها: {{$products->total()}}
            </h5>
        </div>
    <script>
        confirmdelete=function (e){
            if(confirm('آیا از حذف اطمینان دارید؟')==true){
                return true
            }
            else {
                e.preventDefault();
                return false;
            }
        }
    </script>
@endsection
