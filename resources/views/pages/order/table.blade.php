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
                <th>جمع مبلغ</th>
                <th>نام کاربر</th>
                <th>شناسه کالا</th>
                <th>تاریخ ثبت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $or)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$or->id}}</td>
                    <td><img src="{{url('image/'.$or->loc)}}.jpg"width="50px"></td>
                    <td>{{$or->name}}</td>
                    <td>{{number_format($or->price,0,'.',',')}}</td>
                    <td>
                        @if($or->count==0 || !$or->count)
                            اتمام موجودی
                        @else
                            {{$or->count}}
                        @endif
                    </td>
                    <td>
                        {{number_format($or->totalprice,0,'.',',')}}
                    </td>
                    <td>
                        @php
                        $user=\App\Models\User::findOrFail($or->user_id)
                        @endphp
                        {{$user->name}}
                    </td>
                    <td>{{$or->product_id}}</td>
                    <td>{{verta($or->created_at)->format('Y/m/d')}}</td>
                    <td>
                        <a href="{{url('order/edit/'.$or->id)}}" class="btn btn-outline-info" title="ویرایش"><i class="fa fa-edit"></i> </a>
                        <form method="post" action="{{url('/orders/list')}}" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{$or->id}}" name="row">
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
                @if($orders->currentPage()<=1)
                    disabled
                    @endif
            " href="{{url()->current().'?page='.($orders->currentPage()-1)}}">قبلی</a>
            @if($orders->currentPage()>=2)
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($orders->currentPage()-1)}}">{{$orders->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled" href="{{url()->current().'?page='.($orders->currentPage()-1)}}">{{$orders->currentPage()}}</a>
            @if($orders->lastPage()>$orders->currentPage())
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($orders->currentPage()+1)}}">{{$orders->currentPage()+1}}</a>
            @endif
            @if($orders->lastPage()>$orders->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                @if($orders->lastPage()==$orders->currentPage())
                disabled
                @endif
            " href="{{url()->current().'?page='.($orders->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
               تعداد کل رکوردها: {{$orders->total()}}
            </h5>

        </div>
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
