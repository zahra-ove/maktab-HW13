@extends('admin.layouts.master')

@section('content')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>افزودن نظر جدید</h2>
        <br><br>
        <form action="{{route('admin.comments.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label class="control-label" for="field_name" >نام فیلد مورد نظر  </label>
                <input type="text"  name="field_name"  placeholder="نام فیلد مورد نظر"  id="field_name" class="form-control" value="{{old('field_name')}}" required/>
            </div>

            <div class="form-group">
                <label class="control-label" for="field_code" >کد فیلد مورد نظر  </label>
                <input type="text"  name="field_code"  placeholder="کد فیلد مورد نظر"  id="field_code" class="form-control" value="{{old('field_code')}}" required/>
            </div>


            <div class="form-group">
                <label class="control-label" for="body" >متن نظر</label>
                <input type="text"  name="body"  placeholder="متن نظر"  id="body" class="form-control" value="{{old('body')}}" required/>
            </div>


            <div class="form-group">
                <label class="control-label" for="email" >ایمیل</label>
                <input type="email"  name="email"  placeholder="ایمیل"  id="email" class="form-control" value="{{old('email')}}" required/>
            </div>

            <div class="form-group my-5">
                <input type="submit"  value="افزودن"  class="btn btn-primary col-sm-1 control-label">
                <a href="{{route('admin.comments.index')}}" class="btn btn-default">بازگشت <span class="fa fa-arrow-circle-left"></span></a>
            </div>

        </form>
    </div>

@endsection
