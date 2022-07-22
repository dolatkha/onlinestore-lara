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
                <th>مشخصه محصول</th>
                <th>وضعیت</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($prop as $pr)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pr->id}}</td>
                    <td>{{$pr->name}}</td>
                    <td>
                        @if($pr->status==1)
                            <span class="rounded-pill bg-success text-white p-1">فعال</span>
                        @else
                            <span class="rounded-pill bg-danger text-white p-1">غیرفعال</span>
                        @endif
                    </td>
                    <td>{{$pr->desc?$pr->desc:'---'}}</td>
                    <td>
                        <a href="{{route('properties.edit',['property'=>$pr->id])}}" class="btn btn-outline-info" title="ویرایش"><i class="fa fa-edit"></i> </a>
                        <form method="post" action="{{route('properties.destroy',['property'=>$pr->id])}}" class="d-inline">
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
    <div class="text-center col-md4 mb-5 mt-3 col-12">
        <div class="text-center">
            <a class=" btn btn-warning
                @if($prop->currentPage()<=1)
                    disabled
                    @endif
            " href="{{url()->current().'?page='.($prop->currentPage()-1)}}">قبلی</a>
            @if($prop->currentPage()>=2)
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($prop->currentPage()-1)}}">{{$prop->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled" href="{{url()->current().'?page='.($prop->currentPage()-1)}}">{{$prop->currentPage()}}</a>
            @if($prop->lastPage()>$prop->currentPage())
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($prop->currentPage()+1)}}">{{$prop->currentPage()+1}}</a>
            @endif
            @if($prop->lastPage()>$prop->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                @if($prop->lastPage()==$prop->currentPage())
                disabled
                @endif
            " href="{{url()->current().'?page='.($prop->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
               تعداد کل رکوردها: {{$prop->total()}}
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
