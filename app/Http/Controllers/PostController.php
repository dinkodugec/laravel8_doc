<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use Illuminate\Http\Request;
use App\Models\BlogPosts;
use Illuminate\Support\Facades\Gate;
use Illuminate\Container\RewindableGenerator;
/* use Illuminate\Support\Facades\DB;
 */

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     /*    DB::enableQueryLog();

          $posts = BlogPosts::with('comments')->get();

        foreach ($posts as $post) {
           foreach ($post->comments as $comment) {
                echo $comment->content;
             }
         }

        dd(DB::getQueryLog()); */



        return view('posts.index', ['posts' => BlogPosts::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        /* dd($request); */
        $validated = $request->validated();
     /*    $post = new BlogPosts();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post ->save(); */
        $post = BlogPosts::create($validated);

        $request->session()->flash('status', 'The blog post was created!');

        return redirect()->route('posts.show', ['post' => $post->id]);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      /*  abort_if((!isset($this->posts['id'])), 404); */

       return view('posts.show',  ['posts' => BlogPosts::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = BlogPosts::findOrFail($id);


        if(Gate::denies('update-post', $post)) {
            abort(403, "you can not edit this blog posts"); //redirect to specific page with specific message
        }
       return view('posts.edit', ['posts' => BlogPosts::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPosts::findOrFail($id);

       /*  if(Gate::denies('update-post', $post)) {
            abort(403, "you can not edit this blog posts"); //redirect to specific page with specific message
        } */

        $this->authorize('update-post', $post);

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        redirect()->route('posts.show', ['post'=> $post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

     $post = BlogPosts::findOrFail($id);


   /*   if(Gate::denies('delete-post', $post)) {
         abort(403, "you can not delete this blog posts"); //redirect to specific page with specific message
     } */

     $this->authorize('delete-post', $post);
     $post->delete();

     $request->session()->flash('status', 'Blog post was deleted!');

     return redirect()->route('posts.index');

    }
}