<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'comment' => 'required|min:10',
        ]);

        Comment::create([
            'body' => request('comment'),
            'post_id' => request('postid'),
            'user_id' => Auth::user()->id,
        ]);

        //return redirect
        //return redirect()->route('post.show', request('postid'));
        return response('success');
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
        //
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

    public function getcomments(Request $request){
        $post_id = request('post_id');
        //filter comment if it match with post
        //$comments = Comment::where('post_id', $post_id)->get();

        $comments = DB::table('comments')
        ->join('users','users.id', '=', 'comments.user_id')
        ->where('comments.post_id', $post_id)
        ->select('comments.*', 'users.name', 'users.avatar')
        ->get();
        return response($comments);
    }
}
