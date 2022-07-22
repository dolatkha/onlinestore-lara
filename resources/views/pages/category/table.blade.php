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
                <th>دسته بندی کالا</th>
                <th>وضعیت</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cat as $ca)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$ca->id}}</td>
                    <td>{{$ca->title}}</td>
                    <td>{{$ca->status}}</td>
                    <td>{{$ca->description}}</td>
                    <td>
                        <a href="{{route('categories.edit',['category'=>$ca->id])}}" class="btn btn-outline-info" title="ویرایش"><i class="fa fa-edit"></i> </a>
                        <form method="post" action="{{route('categories.destroy',['category'=>$ca->id])}}" class="d-inline">
                            @csrf
                            @method('delete')
{{--                            <input type="hidden" value="{{$ca->id}}" name="row">--}}
                            <button class="btn btn-danger" type="submit" title="حذف" onclick="confirmdelete(event)"><i class="fa fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center col-md-4 mb-5 mt-3 col-12">
{{--        {{$cat->links()}}--}}
        <div class="text-center">
            <a class=" btn btn-warning
                @if($cat->currentPage()<=1)
                    disabled
                    @endif
            " href="{{url()->current().'?page='.($cat->currentPage()-1)}}">قبلی</a>
            @if($cat->currentPage()>=2)
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($cat->currentPage()-1)}}">{{$cat->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled" href="{{url()->current().'?page='.($cat->currentPage()-1)}}">{{$cat->currentPage()}}</a>
            @if($cat->lastPage()>$cat->currentPage())
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($cat->currentPage()+1)}}">{{$cat->currentPage()+1}}</a>
            @endif
            @if($cat->lastPage()>$cat->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                @if($cat->lastPage()==$cat->currentPage())
                disabled
                @endif
            " href="{{url()->current().'?page='.($cat->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
               تعداد کل رکوردها: {{$cat->total()}}
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
