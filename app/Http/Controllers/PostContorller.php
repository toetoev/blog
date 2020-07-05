<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; //call category model to use his data
use App\Post;
use App\Comment;
use Auth;

use Illuminate\Support\Facades\DB;

class PostContorller extends Controller
{
    public function __construct(){
        $this->middleware('author', ['except' =>['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        //GET DATA WITH DB QUERY
        //$post = DB::table('post')->get();

        //joining table with bd query
        /*$posts = DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->select('posts.*', 'categories.name as cname')
                ->get();

        dd($posts);*/

        if ($category_id = request('category_id')) {
            $posts = Post::where('category_id', $category_id)->get();
        } 
        return view('post.index', compact('posts')); //call index which contain post folder

        $comment = Comment::all();
        return view('post.index', compact('comment'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //retrieve category data from category model
        $categories = Category::all();
        return view('post.create',compact('categories')); //take category data from $categories_var
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //testing output result
        //dd($request);

        //validation
        $request->validate([
            'title' => 'required|min:5',
            'photo' => 'required|mimes:jpeg,jpg,png|max:5000',
            'category' => 'required',
            'body' => 'required|min:10'
        ]);

        //upload file
        if ($request->hasfile('photo')) { //take photo from input
            $image = $request->file('photo'); //take the file
            $name = $image->getClientOriginalName(); //take img name
            $image->move(public_path().'/image/',$name); //store in image folder
            $photo = '/image/'.$name;
        } 


        //data save
        //'table column_name => request(col->name)'
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'image' => $photo,
            'category_id' => request('category'),
            'user_id' => Auth::user()->id,
        ]);

        //return redirect
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id); //get each id for detail
        return view('post.show', compact('post'));
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
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
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
        //validation
        $request->validate([
            'title' => 'required|min:5',
            'photo' => 'sometimes|mimes:jpeg,jpg,png|max:5000',
            'category' => 'required',
            'body' => 'required|min:10'
        ]);
        //file upload
        if ($request->hasfile('photo')) { //take photo from input
            $image = $request->file('photo'); //take the file
            $name = $image->getClientOriginalName(); //take img name
            $image->move(public_path().'/image/',$name); //store in image folder
            $photo = '/image/'.$name;
        }else{
            $photo = request('oldimg');
        }
        //data update
        $post = Post::find($id);
        $post->title = request('title');
        $post->image = $photo;
        $post->category_id = request('category');
        $post->user_id = Auth::user()->id;
        $post->body = request('body');

        $post->save();
        //redirect
        return redirect()->route('post.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('post.index');
    }
}
