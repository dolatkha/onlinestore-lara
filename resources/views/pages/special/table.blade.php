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
            @foreach($specials as $sp)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sp->id}}</td>
                    <td>{{$sp->mehmani}}</td>
                    <td>{{$sp->tedad}}</td>
                    <td>{{$sp->date?verta($sp->date)->format('Y/m/d'):'---'}}</td>
                    <td>{{verta($sp->created_at)->format('Y/m/d')}}</td>
                    <td>
                        <a href="{{url('product/edit/'.$sp->id)}}" class="btn btn-outline-info" title="ویرایش"><i class="fa fa-edit"></i> </a>
                        <form method="post" action="{{url('/product/')}}" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{$sp->id}}" name="row">
                            <button class="btn btn-danger" type="submit" title="حذف" onclick="confirmdelete(event)"><i class="fa fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center col-md4 mb-5 mt-3 col-12">
        <div class="text-center">
            <a class=" btn btn-warning
                @if($specials->currentPage()<=1)
                    disabled
                    @endif
            " href="{{url()->current().'?page='.($specials->currentPage()-1)}}">قبلی</a>
            @if($specials->currentPage()>=2)
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($specials->currentPage()-1)}}">{{$specials->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled" href="{{url()->current().'?page='.($specials->currentPage()-1)}}">{{$specials->currentPage()}}</a>
            @if($specials->lastPage()>$specials->currentPage())
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($specials->currentPage()+1)}}">{{$specials->currentPage()+1}}</a>
            @endif
            @if($specials->lastPage()>$specials->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                @if($specials->lastPage()==$specials->currentPage())
                disabled
                @endif
            " href="{{url()->current().'?page='.($specials->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
               تعداد کل رکوردها: {{$specials->total()}}
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
