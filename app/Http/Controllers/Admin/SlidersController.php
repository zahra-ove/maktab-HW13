<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Image;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all slider images from database
        $allSliders = Slider::with('images')->get();

        return view('admin.slides.index')->with('allSliders', $allSliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'  =>   'nullable|string',
            'isActive'     =>   'required|numeric|max:2',
            'slideImg'     =>  'required|image|max:2048'
        ]);


        //saving slide's attribute
        $newSlide = new Slider();

        $newSlide->description  =  $request->post('description');
        $newSlide->isActive  =  $request->post('isActive');

        $newSlide->save();

        if($request->hasFile('slideImg')){
            //get file name with extension
            $fileNamewithExtension = $request->file('slideImg')->getClientOriginalName();
            //get file name
            $filename = pathinfo($fileNamewithExtension, PATHINFO_FILENAME);
            //get file extension
            $fileExtension = $request->file('slideImg')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
            $request->file('slideImg')->storeAs('public/sliders', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';   //if no image is selected by user, then place default image as noimage to this article
        }


        //store product's image in Images table
        $newSlideImage = new Image();
        $newSlideImage->imageable_id = $newSlide->id;
        $newSlideImage->imageable_type = "App\Slider";
        $newSlideImage->image_name = $fileNameToStore;
        $newSlideImage->image_path = "storage/sliders/";

        $newSlideImage->save();


        return redirect('admin/slides')->with('status', 'اسلاید جدید با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.slides.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
