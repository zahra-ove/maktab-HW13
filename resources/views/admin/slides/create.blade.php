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
        <h2>افزودن اسلاید جدید</h2>
        <br><br>


        <form action="{{route('admin.slides.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="descr">توضیحات</label><br/>
                <textarea name="description" id="descr" rows="4" cols="50"></textarea>
            </div>

            <div class="form-group required">
                <label for="isActive" class="col-sm-1 control-label">وضعیت</label>
                  <select name="isActive" id="isActive" class="custom-select form-control col-sm-2" required/>
                        <option value="" selected>--وضعیت--</option>
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                  </select>
            </div>


            <div  class="form-group" >
                <label for="productImg">آپلود تصویر اسلاید</label>
                <input type="file" name="slideImg" id="slideImg" />
            </div>

            {{-- <br/><br/><br/><br/> --}}
            <div class="form-group my-5">
                <input type="submit"  value="افزودن"  class="btn btn-primary col-sm-1 control-label">
                <a href="{{route('admin.slides.index')}}" class="btn btn-default">بازگشت <span class="fa fa-arrow-circle-left"></span></a>
            </div>

        </form>
    </div>

@endsection
