@extends('layouts.layout')

@section('title')
{{'فروشگاه'}}
@endsection

@section('content')
{{-- {{dd($Sliders)}} --}}
{{-- {{dd($newProducts->first()->images->first()->image_name)}} --}}
<div id="container">


{{-- Login success message --}}
    @if(session('status'))
        <div class="container alert alert-success alert-dismissable">
            <button class="close text-white" type="button" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
            {{session('status')}}
        </div>
    @endif
{{-- END of Login success message --}}

    <div class="container">
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">

          <!-- Slideshow Start-->
          <div class="slideshow single-slider owl-carousel justify-content-center">


            @foreach($sliders as $slider)
                @if($slider->isActive == '1')
                 <div class="item mx-sm-0"> <a href="#"><img class="img-responsive" src="{{asset('storage/sliders/'.$slider->images->first()->image_name)}}" alt="banner 1" style="width:100%" /></a> </div>
                @endif
            @endforeach


          </div>

          <!-- Featured محصولات Start-->
          <h3 class="subtitle">جدیدترین محصولات</h3>
          <div class="owl-carousel product_carousel">

            @foreach($newProducts as $newProduct)
                <div class="product-thumb clearfix">
                    <div class="image"><a href="{{route('product', ['id' => $newProduct->id])}}"><img src="{{asset('storage/products/'.$newProduct->images->first()->image_name)}}" alt="تی شرت کتان مردانه" title="{{$newProduct->first()->images->first()->image_name}}" class="img-responsive" /></a></div>
                    <div class="caption">
                    <h4><a href="{{route('product', ['id' => $newProduct->id])}}">{{$newProduct->product_name}}</a></h4>
                    <p class="price"><span>{{$newProduct->product_price}}تومان</span></p>
                    </div>
                    <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('42');"><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="مقایسه this محصولات" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                    </div>
                </div>
            @endforeach


          </div>
          <!-- Featured محصولات End-->

          <!-- دسته ها محصولات Slider Start-->
          <div class="category-module" id="latest_category">
            <h3 class="subtitle">پرفروش ترین کیف های زنانه</h3>
            <div class="category-module-content">
              {{-- <ul id="sub-cat" class="tabs">
                <li><a href="#tab-cat1">لپ تاپ</a></li>
                <li><a href="#tab-cat2">رومیزی</a></li>
                <li><a href="#tab-cat3">دوربین</a></li>
                <li><a href="#tab-cat4">موبایل و تبلت</a></li>
                <li><a href="#tab-cat5">صوتی و تصویری</a></li>
                <li><a href="#tab-cat6">لوازم خانگی</a></li>
              </ul> --}}
              <div id="tab-cat1" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                    @foreach($newBags as $newBag)
                    <div class="product-thumb">
                        <div class="image"><a href="{{route('product', ['id' => $newBag->id])}}"><img src="{{asset('storage/products/'.$newBag->images->first()->image_name)}}" alt="{{$newBag->images->first()->image_name}}" title="{{$newBag->images->first()->image_name}}" class="img-responsive" /></a></div>
                        <div class="caption">
                        <h4><a href="{{route('product', ['id' => $newBag->id])}}">{{$newBag->product_name}}</a></h4>
                        <p class="price"> <span class="price-new">{{$newBag->product_price}} تومان</span></p>
                        <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                        </div>
                        <div class="button-group">
                        <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                        <div class="add-to-links">
                            <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                            <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- دسته ها محصولات Slider End-->

          {{-- جدیدترین ساعت های زنانه --}}
          <div class="category-module" id="latest_category">
            <h3 class="subtitle">جدیدترین ساعت های مچی</h3>
            <div class="category-module-content">

                <div class="owl-carousel latest_category_tabs">
                    @foreach($newwatches as $newWatch)
                        <div class="product-thumb">
                            <div class="image"><a href="{{route('product', ['id' => $newWatch->id])}}"><img src="{{asset('storage/products/'.$newWatch->images->first()->image_name)}}" alt="{{$newWatch->images->first()->image_name}}" title="{{$newWatch->images->first()->image_name}}" class="img-responsive" /></a></div>
                            <div class="caption">
                            <h4><a href="{{route('product', ['id' => $newWatch->id])}}">{{$newWatch->product_name}}</a></h4>
                            <p class="price"> <span class="price-new">{{$newWatch ->product_price}} تومان</span></p>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                            </div>
                            <div class="button-group">
                            <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                            <div class="add-to-links">
                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
                    {{-- جدیدترین ساعت های زنانه اتمام --}}

        </div>
        <!--Middle Part End-->
      </div>
    </div>
  </div>

@endsection
