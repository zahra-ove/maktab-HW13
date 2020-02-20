@extends('admin.layouts.master')

@section('content')

@if(session('status'))
<div class="container alert alert-success alert-dismissable">
    <button class="close text-white" type="button" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
    {{session('status')}}
</div>
@endif
{{-- 
    @if(session('status'))
        <div class="container alert alert-success">
            {{session('status')}}
        </div>
    @endif --}}

    <div class="container ">
        <a href="{{route('admin.comments.create')}}" class="btn btn-sm btn-outline-warning">افزودن نظر جدید</a>
    </div>

    <div class="container">
        <div class="col-auto my-4">
            <!-- check if there is any comment for article or product, then show related tables   -->
            @php
                $isArticleComment = 0;
                $isProductComment = 0;

                foreach($comments as $comment)
                {
                    if($comment->commentable_type == 'App\Article')
                        $isArticleComment = 1;
                    if($comment->commentable_type == 'App\Product')
                        $isProductComment = 1;
                }

            @endphp

            {{-- comments related to products --}}
            @if($isProductComment)
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
            @endif




            {{-- comments related to articles --}}
            @if($isArticleComment)
            <br/><hr/><br/>
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
                                    <td style="width: 10%;"><img src="{{asset('storage/articles/'.$comment->commentable->images[0]->image_name)}}" alt="" style="width: 30%;"></td>
                                    <td style="width: 10%;">{{$comment->body}}</td>
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
            @endif
        </div>
    </div>



@endsection
