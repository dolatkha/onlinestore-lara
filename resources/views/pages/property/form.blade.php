@extends('productmainpage')
@section('product')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-7 mx-auto my-3 shadow bg-light p-5">
                @if($msg)
                    {!! $msg !!}
                @endif
                <form class="form-control" action="
                @if(isset($prop))
                {{route('properties.update',['property'=>$prop->id])}}
                @else
                {{route('properties.store')}}
                @endif
                    " method="post">
                    @csrf
                    @if(isset($prop))
                        @method('put')
                    @endif
                    <label class="form-label mt-3">
                        نام مشخصه محصول:
                    </label>
                    <input type="text" class="form-control" name="name"  value="{{$prop->name??''}}">
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label mt-3">
                        وضعیت:
                    </label>
                    <br>
                    <input type="radio" name="status" value="1"
                           @if(isset($prop) && $prop->status==1)
                           checked
                           @endif
                           class="form-check-input"> فعال
                    <input type="radio" name="status" value="0"
                           @if(isset($prop) && $prop->status==0)
                           checked
                           @endif
                           class="form-check-input"> غیرفعال
                    @error('status')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label mt-3">توضیحات:</label>
                    <textarea class="form-control" rows="4" name="desc">{{$prop->desc??''}}</textarea>
                    @error('desc')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <input type="submit" name="sub" class="btn btn-success mt-2" value="ارسال">
                </form>
            </div>
        </div>
    </div>
@endsection
