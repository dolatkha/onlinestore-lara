@extends('productmainpage')
@section('product')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-7 mx-auto my-3 shadow bg-light p-5">
                @if($msg)
                    {!! $msg !!}
                @endif
                <form class="form-control" action="
                @if(isset($pivot))
                {{url('/product/property/'.$product->id.'/'.$pivot->id.'/edit')}}
                @else
                {{url('/product/property/'.$product->id.'/create')}}
                @endif
                    " method="post">
                    @csrf
                    @if(isset($pivot))
                        @method('put')
                    @endif
                    <label class="form-label mt-3">
                        نام محصول:
                    </label>
                    <input type="text" readonly class="form-control" name="name"  value="{{$product->name}}">
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label class="form-label mt-3">
                        مشخصه محصول:
                    </label>
                    <br>
                    <select class="form-select" name="property">
                        @foreach($allproperty as $props)
                            <option
                                @if(isset($pivot) && $props->id==$pivot->property_id)
                                    selected
                                @endif
                                value="{{$props->id}}">{{$props->name}}</option>
                        @endforeach
                    </select>
                    @error('property')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label mt-3">مقدار:</label>
                    <input type="text" class="form-control" name="amount" value="@if(isset($pivot)){{$pivot->amount}} @endif">
                    @error('amount')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <label class="form-label mt-3">واحد:</label>
                    <input type="text" class="form-control" name="unit" value="@if(isset($pivot)){{$pivot->unit}} @endif">
                    @error('unit')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <br>
                    <input type="submit" name="sub" class="btn btn-success mt-2" value="ارسال">
                </form>
            </div>
        </div>
    </div>
@endsection
