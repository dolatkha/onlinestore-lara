@extends('productmainpage')
@section('product')
    <div class="table-responsive mt-5 px-5">
        @if($msg)
            {!! $msg !!}
        @endif
        <a href="{{url('/product/property/'.$product->id.'/create')}}" class="btn btn-outline-success">اضافه کردن مشخصه
            به محصول</a>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>شناسه</th>
                <th>نام کالا</th>
                <th>دسته بندی کالا</th>
                <th>مفدار</th>
                <th>واحد</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
{{--            {{dd($productwithproperties)}}--}}
            @foreach($productwithproperties as $pr)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pr->product[0]->pivot->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$pr->name}}</td>
                    <td>{{$pr->product[0]->pivot->amount??'---'}}</td>
                    <td>{{$pr->product[0]->pivot->unit??'---'}}</td>
                    <td>
                        <a href="{{url('product/property/'.$product->id.'/'.$pr->product[0]->pivot->id.'/edit')}}" class="btn btn-outline-info"
                           title="ویرایش"><i class="fa fa-edit"></i> </a>
                        <form method="post" action="{{url('/product/property/'.$product->id)}}"
                              class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{$pr->id}}" name="row">
                            <button class="btn btn-danger" type="submit" title="حذف" onclick="confirmdelete(event)"><i
                                    class="fa fa-trash"></i></button>
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
                        @if($productwithproperties->currentPage()<=1)
                disabled
@endif
                " href="{{url()->current().'?page='.($productwithproperties->currentPage()-1)}}">قبلی</a>
            @if($productwithproperties->currentPage()>=2)
                <a class=" btn btn-warning"
                   href="{{url()->current().'?page='.($productwithproperties->currentPage()-1)}}">{{$productwithproperties->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled"
               href="{{url()->current().'?page='.($productwithproperties->currentPage()-1)}}">{{$productwithproperties->currentPage()}}</a>
            @if($productwithproperties->lastPage()>$productwithproperties->currentPage())
                <a class=" btn btn-warning"
                   href="{{url()->current().'?page='.($productwithproperties->currentPage()+1)}}">{{$productwithproperties->currentPage()+1}}</a>
            @endif
            @if($productwithproperties->lastPage()>$productwithproperties->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                        @if($productwithproperties->lastPage()==$productwithproperties->currentPage())
                disabled
@endif
                " href="{{url()->current().'?page='.($productwithproperties->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
                تعداد کل رکوردها: {{$productwithproperties->total()}}
            </h5>
        </div>
    </div>
    <script>
        confirmdelete = function (e) {
            if (confirm('آیا از حذف اطمینان دارید؟') == true) {
                return true
            } else {
                e.preventDefault();
                return false;
            }
        }
    </script>
@endsection
