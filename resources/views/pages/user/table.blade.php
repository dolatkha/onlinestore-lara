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
                <th>نام کاربر</th>
                <th>ایمیل</th>
                <th>وضعیت</th>
                <th>تاریخ ثبت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $us)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$us->id}}</td>
                    <td>{{$us->name}}</td>
                    <td>{{$us->email}}</td>
                    <td>
                        @if($us->typeUser==1)
                            Admin
                        @else
                            User
                        @endif
                    </td>
                    <td>{{verta($us->created_at)->format('Y/m/d')}}</td>
                    <td>
                        <form method="post" action="{{url('/user/list')}}" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{$us->id}}" name="row">
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
                @if($users->currentPage()<=1)
                    disabled
                    @endif
            " href="{{url()->current().'?page='.($users->currentPage()-1)}}">قبلی</a>
            @if($users->currentPage()>=2)
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($users->currentPage()-1)}}">{{$users->currentPage()-1}}</a>
            @endif
            <a class=" btn btn-warning disabled" href="{{url()->current().'?page='.($users->currentPage()-1)}}">{{$users->currentPage()}}</a>
            @if($users->lastPage()>$users->currentPage())
                <a class=" btn btn-warning" href="{{url()->current().'?page='.($users->currentPage()+1)}}">{{$users->currentPage()+1}}</a>
            @endif
            @if($users->lastPage()>$users->currentPage()+1)
                ...
            @endif
            <a class=" btn btn-warning
                @if($users->lastPage()==$users->currentPage())
                disabled
                @endif
            " href="{{url()->current().'?page='.($users->currentPage()+1)}}">بعدی</a>
            <h5 class="text-center mt-2">
               تعداد کل رکوردها: {{$users->total()}}
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
