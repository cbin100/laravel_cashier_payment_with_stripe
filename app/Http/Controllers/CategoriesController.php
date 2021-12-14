<?php

namespace App\Http\Controllers;

//use App\Models\Categories;
use App\Models\Post;
use App\Models\Postmeta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$posts = Post::latest()->paginate(5);
        /*
        $posts = Post::join('posts', 'posts.post_author', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->get();
        */
        /*
        $posts = DB::table('posts')
                    ->join('users', 'posts.post_author', '=', 'users.id')
                    ->select('posts.*', 'users.name')
                    ->get();
       // */
        $posts = User::find(1)->post()
       // $posts = User::find(1);
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('post_type', 'category')
            ->get();


        //$posts->post()->where('post_type', 'category')->get();
        return view('view_admin.category_index', compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('view_admin.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'post_parent_category'
            //'content' => 'required|string|min:5|max:900000'
            //'post_author' => 'required'
        ]);
        $validated['post_content'] = $validated['content'];
        //$validated['post_title'] = $validated['title'];
        $validated['post_title'] = $request->input('title');

        $validated['user_id'] = Auth::user()->id;
        // Create slug from title
        $validated['slug'] = Str::slug($validated['title'], '-');
        $validated['post_name'] = $validated['title'];
        $validated['post_type'] = 'category';

        $validated['guid'] = Str::slug($validated['title'], '-');

        if ($request->has('post_parent_category')){
            $post_parent_id = $request->input('post_parent_category');
            $validated['post_parent_id'] = $post_parent_id;
        } else {
            $post_parent_id = 0;
        }
        //******** INSERTING INPUT INTO posts TABLE **********************
        $post = Post::create($validated);
        // ******** INSERTING INPUT INTO posts TABLE **********************

        if ($post_parent_id > 0) {
            // ******** INSERTING INPUT INTO postmetas TABLE **********************
                $post_option = new Postmeta;
                $post_option->post_id = $post->id;
                $post_option->post_parent_id = $post_parent_id;
                $post_option->save();
            // ******** INSERTING INPUT INTO postmetas TABLE **********************
        }

        // Create and save category with validated data

        //Post::create($validated);
        //Post::create($request->all());
        // Redirect the user to the created category with a success notification
        //return redirect(route('category.show', [$category->slug]))->with('notification', 'Category created!');
        //return redirect()->route('category.show')->with('notification', 'Category created successfully!');
        //return redirect()->route('category.show', ['notification' => 'Category created successfully!']);
        return back()->with('success', 'Category created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $category)
    {
        ///*
        $category = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_type', '=', 'category')
            ->get();
        //*/
        return view('view_admin.category_show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $category)
    {
        return view('view_admin.category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $category)
    {
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
            /*
            'post_author' => [
            'required',
        Rule::exists('posts')->where(function ($query) {
            return $query->where('account_id', 1);
        }),
         */
        ]);
        if ($request->has('post_parent_category')){
            $post_parent_id = $request->input('post_parent_category');
            //$validated['post_parent_id'] = $post_parent_id;
        } else {
            $post_parent_id = 0;
        }
        $validated['post_parent_id'] = $post_parent_id;

        $user = Post::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) AND ((Auth::user()->permission)>(2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        }

        else {
            $validated['post_content'] = $validated['content'];
            //$validated['post_title'] = $validated['title'];
            $validated['post_title'] = $request->input('title');

            //$validated['post_author'] = Auth::user()->id;
            // Create slug from title
            $validated['slug'] = Str::slug($validated['title'], '-');
            $validated['post_name'] = $validated['title'];

            $validated['guid'] = Str::slug($validated['title'], '-');

            // Create and save category with validated data
            //$category = Post::where('id', $category)->update($validated);
            //$posts = Post::update($validated);
            //$category = $posts;

            //$category = Post::save($validated);
            $category->update($validated);
            /*
            $deletedRows = Postmeta::where('post_id', $category->id)->delete();
            $post_option = new Postmeta;
            $post_option->post_id = $category->id;
            $post_option->post_parent_id = $cate;
            $post_option->save();
            */
            //Post::create($request->all());
            // Redirect the user to the created category with a success notification
            //return redirect(route('category.index', [$category->slug]))->with('success', 'Category updated!');
            return redirect(route('category.index'))->with('success', 'Category '. $category->post_title. ' updated!');

            //return redirect(route('category.show', [$category->slug]))->with('notification', 'Category created!');
            //return redirect()->route('category.show')->with('notification', 'Category created successfully!');
            //return redirect()->route('category.show', ['notification' => 'Category created successfully!']);
            //return back()->with('success', 'Article created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $category)
    {
        $user = Post::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) AND ((Auth::user()->permission)>(2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        }

        else {
            //DB::table('posts')->where('id', '=', ($category->id))->delete();
            //OR
            $category->delete();
            return redirect()->route('category.index')
                ->with('success', 'Category ' . $category->post_title . ' deleted successfully');
             }
        }
}
