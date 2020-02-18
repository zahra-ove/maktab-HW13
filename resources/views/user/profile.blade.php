@extends('layouts.layout')

@section('content')


<div class="container">
    <br/><br/><br/>

        <div style="width:30%;">

                {{-- <img src="" class="card-img-top" alt="user profile image"> --}}

                  <p ><pre style="margin-bottom:0;">{{Auth::user()->name}}   خوش آمدید</pre> </p>

                <ul class="list-group list-group-flush">
                  <li class="list-group-item">مشاهده سبد خرید</li>
                  <li class="list-group-item">سفارشات</li>
                  <li class="list-group-item">پشتیبانی</li>
                  <li class="list-group-item">ویرایش مشخصات</li>
                </ul>

        </div>


</div>
@endsection
