@extends('admin.layouts.master')

@section('content')

@if(session('status'))
    <div class="container alert alert-success">
        {{session('status')}}
    </div>
@endif


<div class="container ">
    <a href="{{route('admin.slides.create')}}" class="btn btn-sm btn-outline-warning">افزودن اسلاید جدید</a>
</div>

<div class="row justify-content-center">
    <div class="col-sm-9">
        <div class="col-auto my-4">
            <table class="table-responsive-sm  table-bordered table-hover text-center mytable">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>فعال</th>
                        <th>توضیحات</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ ویرایش</th>
                        <th>سلاید</th>
                        <th>تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allSliders as $slide)
                        <tr>
                            <td>{{$slide->id}}</td>
                            <td>{{$slide->isActive}}</td>
                            <td>{{$slide->description}}</td>
                            <td>{{$slide->created_at}}</td>
                            <td>{{$slide->updated_at}}</td>
                            <td><img src="{{asset('storage/sliders/'.$slide->images->first()->image_name)}}" style="width:20%;height:20%;"></td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ route('admin.slides.edit', ['slide' => $slide] ) }}" class="btn btn-sm btn-primary">ویرایش</a>

                                <form action="{{route('admin.slides.destroy', ['slide' => $slide])}}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
