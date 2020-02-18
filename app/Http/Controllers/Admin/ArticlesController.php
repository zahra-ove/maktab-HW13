<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\Image;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articles = Article::all();
        $articles = Article::with('images')->orderBy('created_at', 'desc')->get();
        // $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
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
            'title' => 'required|string',
            'body'  => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if($request->hasFile('image')){
            //get file name with extension
            $fileNamewithExtension = $request->file('image')->getClientOriginalName();
            //get file name
            $filename = pathinfo($fileNamewithExtension, PATHINFO_FILENAME);
            //get file extension
            $fileExtension = $request->file('image')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
            $request->file('image')->storeAs('public/articles', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $article = new Article();

        $article->article_title  =  $request->post('title');
        $article->article_body   =  $request->post('body');
        // $article->article_image  = $fileNameToStore;
        $article->save();

        //store images for this article in images table (polymorphic relationships)
        $newArticleImage = new Image();
        $newArticleImage->image_name = $fileNameToStore;
        $newArticleImage->image_path = "/public/articles";
        $newArticleImage->imageable_type = "App\Article";
        $newArticleImage->imageable_id = $article->id;
        $newArticleImage->save();



        return redirect('admin/articles')->with('status', 'مقاله با موفقیت ذخیره شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $article = Article::find($id);
        return view('admin.articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('admin.articles.edit')->with('article', $article);
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
        $request->validate([
            'title' => 'required|string',
            'body'  => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // image processing
        if($request->hasFile('image')){
            //get file name with extension
            $fileNamewithExtension = $request->file('image')->getClientOriginalName();
            //get file name
            $filename = pathinfo($fileNamewithExtension, PATHINFO_FILENAME);
            //get file extension
            $fileExtension = $request->file('image')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
            $request->file('image')->storeAs('public/articles', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';   //if no image is selected by user, then place default image as noimage to this article
        }

        //finding intended article based on id
        $article = Article::find($id);
        $newArticleImage = new Image;

        //saving user input data
        $article->article_title = $request->post('title');
        $article->article_body = $request->post('body');
        $article->save();


        //add new inserted image to images table
        if($request->hasFile('image')){
            // Storage::delete('public/articles'.$article->article_image);   //first delete old image
            // $article->article_image = $fileNameToStore;   //then save new image that is uploaded
            $newArticleImage->image_name = $fileNameToStore;
            $newArticleImage->image_path = "/public/articles";
            $newArticleImage->imageable_id = $article->id;
            $newArticleImage->imageable_type = "App\Article";
            $newArticleImage->save();
        }


        return redirect('admin/articles')->with('status', 'مقاله با موفقیت ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $article = Article::find($id);

        //finding article image name
        $articleImageName = $article->images()->first()->image_name;

        if($articleImageName != 'noimage.jpg')
        {
            Storage::delete('public/articles/'. $articleImageName);  //delete image from storage
        }

        $article->comments()->delete();   //delete all comments related to this article
        $article->images()->delete();   //delete all images related to this article
        $article->delete();

        return redirect('admin/articles')->with('status', 'مقاله با موفقیت حذف شد.');
    }
}
