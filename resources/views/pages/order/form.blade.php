@extends('productmainpage')
@section('product')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-7 mx-auto my-3 shadow bg-light p-5">
                @if($msg)
                    {!! $msg !!}
                @endif
                <form class="form-control" action="
                    @if(isset($ordit))
                        {{url('/order/edit/'.$ordit->id)}}
                    @else
                        {{url('/order/add')}}
                    @endif
                    " method="post">
                    @csrf
                    @if(isset($ordit))
                        @method('put')
                    @endif
                    <label class="form-label">
                        نام کالا :
                    </label>
                    <input type="text" class="form-control" name="name"  value="{{$ordit->name??''}}">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label">
                        قیمت :
                    </label>
                    <input type="number" class="form-control" name="price"  value="{{$ordit->price??''}}">
                    @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label">
                        تعداد :
                    </label>
                    <input type="number" class="form-control" name="count" value="{{$ordit->count??''}}">
                    @error('count')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <input type="submit" name="sub" class="btn btn-success mt-2" value="ارسال">
                </form>
            </div>
        </div>
    </div>
    <script>
        jalaliDatepicker.startWatch();
    </script>
@endsection
