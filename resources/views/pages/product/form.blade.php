@extends('productmainpage')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('css/jalalidatepicker.min.css')}}" />
    <script type="text/javascript" src="{{url('js/jalalidatepicker.min.js')}}"></script>
@endsection
@section('product')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-7 mx-auto my-3 shadow bg-light p-5">
                @if($msg)
                    {!! $msg !!}
                @endif
                <form class="form-control" action="
                    @if(isset($predit))
                        {{url('/product/edit/'.$predit->id)}}
                    @else
                        {{url('/product/add')}}
                    @endif
                    " method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($predit))
                        @method('put')
                    @endif
                    <label class="form-label">
                        نام کالا :
                    </label>
                    <input type="text" class="form-control" name="name"  value="{{$predit->name??''}}">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    @if(isset($predit) && isset($predit->loc))
                        <div class="my-1">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($predit->loc)}}"width="150px">
                        </div>
                    @endif
                    <label class="form-label">
                        تصویر کالا :
                    </label>
                    <input type="file" class="form-control" name="loc">
                    @error('loc')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label">
                        قیمت :
                    </label>
                    <input type="number" class="form-control" name="price"  value="{{$predit->price??''}}">
                    @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label">
                        تعداد :
                    </label>
                    <input type="number" class="form-control" name="count" value="{{$predit->count??''}}">
                    @error('count')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label pt-2">
                        وضعیت کالا :
                    </label>
                    <br>
                    <input type="radio" name="status" value="1"
                           @if(isset($predit) && $predit->status==1)
                               checked
                           @endif
                           class="form-check-input">   فعال
                    <input type="radio" name="status" value="0"
                           @if(isset($predit) && $predit->status==0)
                               checked
                           @endif
                           class="form-check-input"> غیر فعال
                    @error('status')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label pt-2">
                        عنوان کالا :
                    </label>
                    <select name="cat" class="form-select">
                        @foreach ($cats as $ca)
                            <option value="{{$ca->id}}"
                                @if(isset($predit) && $predit->category_id==$ca->id)
                                    selected
                                @endif
                            >{{$ca->title}}</option>
                        @endforeach
                    </select>
                    @error('cat')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label pt-2">
                        تاریخ ایجاد :
                    </label>
                    <input type="text" data-jdp class="form-control" name="start_date" value="{{isset($predit->start_date)?verta($predit->start_date)->format('Y/m/d'):''}}" placeholder="1401/02/10">
                    @error('start_date')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <input type="submit" name="sub" class="btn btn-success mt-2" value="ارسال">
                </form>
            </div>
        </div>
    </div>
    <script>
        jalaliDatepicker.startWatch();
    </script>
@endsection
