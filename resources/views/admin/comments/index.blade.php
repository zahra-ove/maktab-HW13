@extends('admin.layouts.master')

@section('content')



    @if(session('status'))
        <div class="container alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <div class="container ">
        <a href="{{route('admin.comments.create')}}" class="btn btn-sm btn-outline-warning">افزودن نظر جدید</a>
    </div>
    <div class="col-auto my-4">

        {{-- comments related to products --}}

        <table class="table-responsive-sm  table-bordered table-hover text-center mytable">
            <thead class="thead-light">
                <tr>
                    <th>شماره</th>
                    <th>کد فیلد موردنظر</th>
                    <th>فیلد موردنظر</th>
                    <th>متن نظرات</th>
                    <th>ایمیل کاربر</th>
                    <td>تنظیمات</td>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    @if($comment->commentable_type == 'App\Product')
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->commentable->product_code}}</td>
                            <td>{{$comment->commentable->product_name}}</td>
                            <td>{{$comment->body}}</td>
                            <td>{{$comment->user->email}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.comments.edit', ['comment' => $comment] ) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                    <form action="{{route('admin.comments.destroy', ['comment' => $comment])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>


        <br/><hr/><br/>

        {{-- comments related to articles --}}

        <table class="table-responsive-sm  table-bordered table-hover text-center mytable">
            <thead class="thead-light">
                <tr>
                    <th>شماره</th>
                    <th>عنوان مقاله</th>
                    <th>تصویر مقاله</th>
                    <th>متن نظر</th>
                    <th>ایمیل کاربر</th>
                    <td>تنظیمات</td>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    @if($comment->commentable_type == 'App\Article')
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->commentable->article_title}}</td>
                            <td><img src="{{asset('storage/articles/'.$comment->commentable->article_image)}}" alt="" style="width: 70%;"></td>
                            <td>{{$comment->body}}</td>
                            <td>{{$comment->user->email}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.comments.edit', ['comment' => $comment] ) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                    <form action="{{route('admin.comments.destroy', ['comment' => $comment])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>




@endsection
