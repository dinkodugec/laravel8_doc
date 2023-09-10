<?php

namespace App\Http\Controllers;

use App\Events\BlogPostPosted;
use App\Http\Requests\StorePost;
use Illuminate\Http\Request;
use App\Models\BlogPosts;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

/* use Illuminate\Support\Facades\DB;
 */


 // [  for policy Laravel genereted poilicy for method in resource controller
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]
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



 /*        return view('posts.index', ['posts' => BlogPosts::latest()->withCount('comments')->get()->with('users')->with('tags')->get(), //eager loading
        'mostCommented' => BlogPosts::mostCommented()->take(5)->get(),
        'mostActive' => User::withMostBlogPosts()->take(5)->get(),
        'mostActiveLastMonth' => User::withMostBlogPostsLastMonth()->take(5)->get(),
        'postWithComments" => BlogPosts::has('comments')->get()
        '
    ]); */

    $mostCommented = Cache::remember('mostCommented', 60, function() {
        return BlogPosts::mostCommented()->take(5)->get();
    });

    $mostActive = Cache::remember('mostCommented', 60, function() {
        return User::withMostBlogPosts()->take(5)->get();
    });

    $mostActiveLastMonth = Cache::remember('mostCommented', 60, function() {
        return User::withMostBlogPostsLastMonth()->take(5)->get();
    });

    $posts = BlogPosts::all();

    /* $trashedPosts = BlogPosts::onlyTrashed()->get()->pluck('title');  This will back a collcetion of trashed models*/



    return view('posts.index', [
        'posts' => BlogPosts::latest()->withCount('comments')->with('user')-> get(),
        // 'posts' => BlogPosts::paginate(10),
        'mostCommented' => $mostCommented,
        'mostActive' => $mostActive,
        'mostActiveLastMonth' => $mostActiveLastMonth,
        /* 'trashedPosts' => BlogPosts::withTrashed()->get(), //withTrashed method is starting a new instance of querybuilder so we get collection
         'onlyTrashed' => BlogPosts::onlyTrashed()->get()->pluck('title') //only one property from collection */
       /*   'onlyTrashed' => BlogPosts::onlyTrashed()->where('id', 13)->get()*/
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         /*  $this->authorize('posts.create'); */
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

        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post = BlogPosts::create($validated);





        if($request->hasFile('thumbnail')) {                                //if file is uploaded
            $path = $request->file('thumbnail')->store('thumbnails');         //store in thumbnails folder
            $post->image()->save(
            Image::make(['path' => $path])
            );
        }

        event(new BlogPostPosted($post));



        $request->session()->flash('status', 'The blog post was created!');

        return redirect()->route('post.show', ['post' => $post->id]);
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

        // return view('posts.show', [
        //     'post' => BlogPosts::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id),
        // ]);

         $blogPost = Cache::remember("blog-post-{$id}", 60, function() use($id) {
            return BlogPosts::with('comments', 'tags')
             //->with('comments.user')nested relation - with relation comments and user
            ->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::forever($usersKey, $usersUpdate);

        if (!Cache::has($counterKey)) {
            Cache::forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $diffrence);
        }

        $counter = Cache::get($counterKey);




        return view('posts.show', [
           /*  'post' => BlogPosts::with('comments')->with('tags')->with('tags')->findOrFail($id), //eager loading */
           'post' => $blogPost,
           'counter' => $counter
        ]);
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



  /*       $this->authorize('update', $post);  //method define in policy

        if(Gate::denies('update-post', $post)) {
            abort(403, "you can not edit this blog posts"); //redirect to specific page with specific message
        } */
       return view('posts.partials.edit')->with($post);
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

        $this->authorize('update', $post);

        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }


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
    public function destroy($id)
    {

     $post = BlogPosts::findOrFail($id);


   /*   if(Gate::denies('delete-post', $post)) {
         abort(403, "you can not delete this blog posts"); //redirect to specific page with specific message
     } */

     /* $this->authorize('delete', $post); */
     $post->delete();

    session()->flash('status', 'Blog post was deleted!');

     return redirect()->route('post.index');

    }
}