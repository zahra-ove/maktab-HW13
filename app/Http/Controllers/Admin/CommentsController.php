<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\User;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all comments
    public function index()
    {
        $comments = Comment::with('user')->get();
        // $comments = Comment::find(3);
        // return $comments->first()->commentable()->first()->images()->get();
        return view('admin.comments.index')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comments.create');
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
            'field_name' => 'required|string',
            'field_code' => 'required|numeric',
            'body'       => 'required|string',
            'email'       => 'required|string',
        ]);

        $email = $request->post('email');

        //find user id based on user email that is enetered in create new comments form
        $user = User::where('email', $email)->get();
        $id = $user->first()->id;

        //initializing comment model
        $newComment = new Comment();

        $newComment->commentable_type = $request->post('field_name');
        $newComment->commentable_id = $request->post('field_code');
        $newComment->body = $request->post('body');
        $newComment->user_id = $id;

        $newComment->save();
        return redirect('admin/comments')->with('status', 'نظر جدید اضافه شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
        return view('admin.comments.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
// we can not edit field name, because column name of different table that have ppolymorphic relation differs from eachother
    public function update(Request $request, $id)
    {
        //find related comment
        $editedComment = Comment::find($id);

        //validate received data from edit form
        $request->validate([
            'field_code'  =>  'required|numeric',
            'body'        =>  'required|string',
            'email'       => 'required|string',
        ]);

        $email = $request->post('email');

        //find user id based on user email that is enetered in create new comments form
        $user = User::where('email', $email)->get();
        $id = $user->first()->id;


        $editedComment->commentable_id   = $request->post('field_code');
        $editedComment->body             = $request->post('body');
        $editedComment->user_id          = $id;

        $editedComment->save();
        return redirect('admin/comments')->with('status', 'نظر ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteComment = Comment::find($id);
        $deleteComment->delete();

        return redirect('admin/comments')->with('status', "نظر مورد نظر با موفقیت حذف شد.");
    }
}
