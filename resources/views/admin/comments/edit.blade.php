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
        <h2>ویرایش نظر</h2>
        <br><br>
        <form action="{{route('admin.comments.update' ,['comment'=>$comment])}}" method="post">
            @csrf
            @method('PUT')
            {{-- <div class="form-group">
                <div class="form-group required">
                    <label for="field_name" class="col-sm-1 control-label">فیلدموردنظر</label>
                      <select name="field_name" id="field_name" class="custom-select form-control col-sm-2" required/>
                            <option value="">--فیلد--</option>
                            <option value="App\Product"  @if($comment->commentable_type == 'App\Product')  {{"selected"}} @else {{""}} @endif>محصولات</option>
                            <option value="App\Article"  @if($comment->commentable_type == 'App\Article')  {{"selected"}} @else {{""}} @endif>مقالات</option>
                      </select>
                </div>
            </div> --}}

            <div class="form-group">
                <label class="control-label" for="field_code" >کد فیلد مورد نظر  </label>
                <input type="text"  name="field_code"  placeholder="کد فیلد مورد نظر"  id="field_code" class="form-control" value="{{$comment->commentable_id}}" required/>
            </div>


            <div class="form-group">
                <label class="control-label" for="body" >متن نظر</label>
                <input type="text"  name="body"  placeholder="متن نظر"  id="body" class="form-control" value="{{$comment->body}}" required/>
            </div>


            <div class="form-group">
                <label class="control-label" for="email" >ایمیل</label>
                <input type="email"  name="email"  placeholder="ایمیل"  id="email" class="form-control" value="{{$comment->user->email}}" required/>
            </div>

            <div class="form-group my-5">
                <input type="submit"  value="افزودن"  class="btn btn-primary col-sm-1 control-label">
                <a href="{{route('admin.comments.index')}}" class="btn btn-default">بازگشت <span class="fa fa-arrow-circle-left"></span></a>
            </div>

        </form>
    </div>

@endsection
