<?php

namespace App\Http\Controllers;

//use App\Post;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Postmeta;
use App\Models\ProductMeta;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Slidershow;

use function PHPUnit\Framework\isNull;
//use Intervention\Image\Image;
use Image;
class PostController extends Controller
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
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_type', '=', 'article')
            ->get();

        return view('view_admin.article_index', compact('posts'))
            ->with('i', (request()->input('page', 1) -1) *5);
            //->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('view_admin.article_create');
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
            //'post_title' => 'required|unique:posts|min:2',
            'post_title' => 'required|min:2',
            'post_content' => 'required',
            'post_caption' => 'required',
            'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000'

        ]);
        //$validated['post_content'] = $validated['post_content'];
        //$validated['post_title'] = $validated['title'];
        //$validated['post_title'] = $request->input('post_title');
        //
        $x_size = 600;
        $y_size = 415;
        if (($request->filled('x_size')) OR ($request->filled('y_size'))) {
            if ($request->filled('x_size')) {
                $x_size = $request->input('x_size');
            }
            if ($request->filled('y_size')) {
                $y_size = $request->input('y_size');
            }
        }
        if ($request->hasFile('file_upload'))
        {
            /*
            $original_name = $request->file_upload->getClientOriginalName();
            $extension = $request->file_upload->getClientOriginalExtension();
            $path = $request->file_upload->storeAs('public/pelouploads/', $original_name);
            */
            $imagePath = $request->file('file_upload');
            $original_name = $imagePath->getClientOriginalName();
            $extension = $imagePath->getClientOriginalExtension();
            //$path = $request->file('file_upload')->storeAs('pelouploads', $original_name, 'public');

            //////$original_name = $request->file('file_upload')->getClientOriginalName();
            //////$extension = $request->file_upload->getClientOriginalExtension();
            /////$path = $request->file_upload->storeAs('public/pelouploads/', $original_name);

            //$url = Storage::url('app/'.$path);
            //$url = Storage::url($path);
            ///////Storage::put($imagePath, $request->post_content);
            $validated['post_name'] = $original_name;
            //$validated['guid'] = $url;
            ///////$validated['guid'] = 'storage/' .$path;
            //$validated['guid'] = $path;

            $validated['post_mime_type'] = $extension;

            $image_file_resize = Image::make($imagePath->getRealPath());
            $image_file_resize->resize($x_size, $y_size);
            $image_resize = $image_file_resize->save(public_path('images/'.$original_name));
            $savedImagePath = public_path('images/'.$original_name);
            //$validated['post_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));
            //$validated['post_mine_base64'] = base64_encode(file_get_contents($image_resize));
            //$validated['post_mine_base64'] = base64_encode(file_get_contents(public_path('images/'.$original_name)));
            $validated['post_mine_base64'] = base64_encode(file_get_contents($savedImagePath));



        }
        else {
            /////$validated['post_name'] = $original_name;
            //////$validated['post_mime_type'] = $extension;
            $validated['guid'] = Str::slug($validated['post_title'], '-');

        }

        $validated['user_id'] = Auth::user()->id;
        $validated['slug'] = Str::slug($validated['post_title'], '-');
        $validated['post_status'] = $request->input('post_status');

        //$validated['post_name'] = $validated['post_title'];

        // Create slug from title
        $validated['post_type'] = "article";
        //$validated['post_mime_type'] = "";
        //$validated['checked_comment'] = $validated['checked_comment'];

        $validated['post_status'] = $request->input('post_status');

        if( $request->has('checked_comment') ){
            $validated['comment_status'] = 'open';
        } else {
            $validated['comment_status'] = 'closed';
        }

        $validated['post_comment_count'] =0;
        //if ($request->filled('checked_to_ping')) {
        if ($request->has('checked_to_ping')){
            $validated['post_priority'] = $request->input('checked_to_ping');
        }
        else {
            $validated['post_priority'] = 0;
        }

        $validated['external_link'] = $request->input('external_link');

        $post = Post::create($validated);
        $post->id;
        if (isset($_POST['checked_category'])) {

        }
        // OR******************************
        if ($request->has('checked_category')){
            foreach ($_POST['checked_category'] as $cate) {
                //$post_option->post_id = implode(',', (array) $request->get('checked_category'));
                //$post_option->post_id = implode(',',(array) $cate);
                $post_option = new Postmeta;
                $post_option->post_id = $post->id;
                $post_option->post_parent_id = $cate;
                $post_option->save();
            }
           //88888 DB::table("postmetas")->whereIn('post_id',explode(",",$ids))->create();
            //DB::table("postmetas")->whereIn('post_id',explode(",",$ids))->create();
        }
        return redirect()->route('posts.index')->with('success', 'Post '.$post->post_title. ' created successfully! ');





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('view_admin.article_show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('view_admin.article_edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validate posted form data
        $validated = $request->validate([
            'post_title' => 'required|min:2',
            'post_content' => 'required',
            'post_caption' => 'required',
            'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000'
        ]);
        $user = Post::where('user_id', '=', (Auth::user()->id))->first();

        //$validated['post_title'] = $request->input('post_title');
        //$validated['post_content'] = $request->input('post_content');
        $validated['slug'] = Str::slug($validated['post_title'], '-');
        $validated['post_name'] = $validated['post_title'];
        //$validated['guid'] = Str::slug($validated['post_title'], '-');
        $validated['post_status'] = $request->input('post_status');

        if( $request->has('checked_comment') ){
            $validated['comment_status'] = 'open';
        } else {
            $validated['comment_status'] = 'closed';
        }

        $validated['post_comment_count'] =0;
        //if ($request->filled('checked_to_ping')) {
        if ($request->has('checked_to_ping')){
            //$validated['post_priority'] = $request->input('checked_to_ping');
            $validated['post_priority'] = 1;
        }
        else {
            $validated['post_priority'] = 0;
        }

        $x_size = 600;
        $y_size = 415;
        if (($request->filled('x_size')) OR ($request->filled('y_size'))) {
            if ($request->filled('x_size')) {
                $x_size = $request->input('x_size');
            }
            if ($request->filled('y_size')) {
                $y_size = $request->input('y_size');
            }
        }

        if (($user === null) and ((Auth::user()->permission) > (2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        } else {

            if ($request->hasFile('file_upload'))
            {
             // ****** DELETE PREVIOUS IMAGE *******************
                //Storage::disk('public')->delete($post->guid);
                // ****** DELETE PREVIOUS IMAGE *******************

                $imagePath = $request->file('file_upload');
                $original_name = $imagePath->getClientOriginalName();
                $extension = $imagePath->getClientOriginalExtension();
                //$path = $request->file('file_upload')->storeAs('pelouploads', $original_name, 'public');

                //$url = Storage::url($path);
                ////////////Storage::put($imagePath, $request->post_content);
                $validated['post_name'] = $original_name;
                //$validated['guid'] = $url;
                //$validated['guid'] = $path;
                ////////$validated['guid'] = 'storage/' .$path;

                $validated['post_mime_type'] = $extension;
                //$validated['post_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));

                $image_file_resize = Image::make($imagePath->getRealPath());
                $image_file_resize->resize($x_size, $y_size);
                $image_resize = $image_file_resize->save(public_path('images/'.$original_name));
                $savedImagePath = public_path('images/'.$original_name);
                //$validated['post_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));
                //$validated['post_mine_base64'] = base64_encode(file_get_contents($image_resize));
                //$validated['post_mine_base64'] = base64_encode(file_get_contents(public_path('images/'.$original_name)));
                $validated['guid'] = $savedImagePath;
                $validated['post_mine_base64'] = base64_encode(file_get_contents($savedImagePath));

            }
            else {
                //$validated['guid'] = Str::slug($validated['post_title'], '-');
            }

            $validated['external_link'] = $request->input('external_link');
            $post->update($validated);
            // DELETE OLD PARENT CATEGORIES
            $deletedRows = Postmeta::where('post_id', $post->id)->delete();

            if ($request->has('checked_category')) {
                foreach ($_POST['checked_category'] as $cate) {
                    $post_option = new Postmeta;
                    $post_option->post_id = $post->id;
                    $post_option->post_parent_id = $cate;
                    $post_option->save();
                }
            }
            return back()->with('success', ' ' . $post->post_title . ' updated successfully.');

           // return redirect(route('posts.index'))->with('success', 'Category ' . $post->post_title . ' updated!');


        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $user = Post::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) AND ((Auth::user()->permission)>(2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        }

        else {
            //**************DELETE POSTMETAS*********************
            //Storage::disk('public')->delete('pelouploads/'.$post->post_name);
            //OR
            Storage::disk('public')->delete($post->guid);
            //Storage::disk('public')->delete('pelouploads/'.$post->guid);
            //Storage::disk('public')->delete($post->guid);
            DB::table('postmetas')->where('post_id', '=', ($post->id))->delete();
            //************DELETE POST********************************************************
            $post->delete();

            return back()->with('success', ' ' . $post->post_title . ' deleted successfully.');
            /*
            return redirect()->route('posts.index')
                ->with('success', 'Post ' . $post->post_title . ' deleted successfully');
            */
        }
    }


    public function categoryindex()
    {
        $posts = User::find(1)->post()
           // $posts = DB::table('posts')
            // $posts = User::find(1);
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('post_type', 'category')
            ->get();


        //$posts->post()->where('post_type', 'category')->get();
        return view('view_admin.category_index', compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function categoryshow(Post $post)
    {
        ///*
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_type', '=', 'category')
            ->get();
        //*/
        return view('view_admin.category_show', compact('post'));
    }

    public function categoryedit(Post $post)
    {
        return view('view_admin.category_edit', compact('post'));
    }

    public function categorycreate()
    {
        return view('view_admin.category_create');
    }

    public function categorystore(Request $request)
    {
        // Validate posted form data
        $validated = $request->validate([
            //'title' => 'required',
            'title' => 'required|min:2',
            'content' => 'required'
           // 'post_parent_category'

        ]);
        $validated['post_content'] = $validated['content'];
        //$validated['post_title'] = $validated['title'];
        $validated['post_title'] = $request->input('title');
        //
        $validated['user_id'] = Auth::user()->id;
        //
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
        $validated['post_parent'] = $post_parent_id;

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

        return back()->with('success', 'Category created successfully.');

    }


    public function categoryupdate(Request $request, Post $post)
    {
        // Validate posted form data
        $validated = $request->validate([
            //'title' => 'required',
            'title' => 'required|min:2',
            'content' => 'required'

        ]);
        $user = Post::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) AND ((Auth::user()->permission)>(2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        }

        else {
            $validated['post_content'] = $validated['content'];
            //$validated['post_title'] = $validated['title'];
            $validated['post_title'] = $request->input('title');

            $validated['slug'] = Str::slug($validated['title'], '-');
            $validated['post_name'] = $validated['title'];

            $validated['guid'] = Str::slug($validated['title'], '-');

            if ($request->has('post_parent_category')){
                $post_parent_id = $request->input('post_parent_category');
                $validated['post_parent_id'] = $post_parent_id;
            } else {
                $post_parent_id = 0;
            }

            $post->update($validated);

            if ($post_parent_id > 0) {
                // ******** INSERTING INPUT INTO postmetas TABLE **********************
                $post_option = new Postmeta;
                $post_option->post_id = $post->id;
                $post_option->post_parent_id = $post_parent_id;
                $post_option->save();
                // ******** INSERTING INPUT INTO postmetas TABLE **********************
            }
            return redirect(route('category.index'))->with('success', 'Category '. $post->post_title. ' updated!');

        }
    }







// FUNCTION ON PAGES

    public function pageindex()
    {
        //$posts = Post::latest()->paginate(5);
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_type', '=', 'page')
            ->get();

        return view('view_admin.page_index', compact('posts'))
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    public function pagecreate()
    {
        return view('view_admin.page_create');
    }
    public function pagestore(Request $request)
    {
        $validated = $request->validate([
            //'post_title' => 'required|unique:posts|min:2',
            'post_title' => 'required|min:2',
            'post_content' => 'required',
            'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000'
        ]);

        $x_size = 600;
        $y_size = 415;
        if (($request->filled('x_size')) OR ($request->filled('y_size'))) {
            if ($request->filled('x_size')) {
                $x_size = $request->input('x_size');
            }
            if ($request->filled('y_size')) {
                $y_size = $request->input('y_size');
            }
        }

        if ($request->hasFile('file_upload'))
        {
            $imagePath = $request->file('file_upload');
            $original_name = $imagePath->getClientOriginalName();
            $extension = $imagePath->getClientOriginalExtension();
            //$path = $request->file('file_upload')->storeAs('pelouploads', $original_name, 'public');

            //$url = Storage::url('app/'.$path);
            $validated['post_name'] = $original_name;
            //$validated['guid'] = $url;
            //$validated['guid'] = $path;
            //////$validated['guid'] = 'storage/' .$path;
            $validated['post_mime_type'] = $extension;
            //
            $image_file_resize = Image::make($imagePath->getRealPath());
            $image_file_resize->resize($x_size, $y_size);
            $image_resize = $image_file_resize->save(public_path('images/'.$original_name));
            $savedImagePath = public_path('images/'.$original_name);
            //$validated['post_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));
            //$validated['post_mine_base64'] = base64_encode(file_get_contents($image_resize));
            //$validated['post_mine_base64'] = base64_encode(file_get_contents(public_path('images/'.$original_name)));
            $validated['guid'] = $savedImagePath;
            $validated['post_mine_base64'] = base64_encode(file_get_contents($savedImagePath));

        }
        else {
           $validated['guid'] = Str::slug($validated['post_title'], '-');

        }

        $validated['user_id'] = Auth::user()->id;
        $validated['slug'] = Str::slug($validated['post_title'], '-');
        // Create slug from title
        $validated['post_type'] = "page";

        $validated['post_status'] = $request->input('post_status');

        if( $request->has('checked_comment') ){
            $validated['comment_status'] = 'open';
        } else {
            $validated['comment_status'] = 'closed';
        }

        $validated['post_comment_count'] =0;
        //if ($request->filled('checked_to_ping')) {
        if ($request->has('checked_to_ping')){
            $validated['post_priority'] = $request->input('checked_to_ping');
        }
        else {
            $validated['post_priority'] = 0;
        }

        $pages = Post::create($validated);

        return redirect()->route('pages.index')->with('success', 'Post '.$pages->post_title. ' created successfully! ');

    }

    public function pageedit(Post $post)
    {
        return view('view_admin.page_edit', compact('post'));

    }
//
    public function pageupdate(Request $request, Post $post)
    {
        // Validate posted form data
        $validated = $request->validate([
            'post_title' => 'required|min:2',
            'post_content' => 'required',
            'file_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5000'
        ]);
        $user = Post::where('user_id', '=', (Auth::user()->id))->first();

        $validated['slug'] = Str::slug($validated['post_title'], '-');
        $validated['post_name'] = $validated['post_title'];
        //$validated['guid'] = Str::slug($validated['post_title'], '-');
        $validated['post_status'] = $request->input('post_status');
        //
        if( $request->has('checked_comment') ){
            $validated['comment_status'] = 'open';
        } else {
            $validated['comment_status'] = 'closed';
        }
        //
        if ($request->has('checked_to_ping')){
            //$validated['post_priority'] = $request->input('checked_to_ping');
            $validated['post_priority'] = 1;
        }
        else {
            $validated['post_priority'] = 0;
        }
        //
        $x_size = 600;
        $y_size = 415;
        if (($request->filled('x_size')) OR ($request->filled('y_size'))) {
            if ($request->filled('x_size')) {
                $x_size = $request->input('x_size');
            }
            if ($request->filled('y_size')) {
                $y_size = $request->input('y_size');
            }
        }
        if (($user === null) and ((Auth::user()->permission) > (2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        } else {

            if ($request->hasFile('file_upload'))
            {
                // ****** DELETE PREVIOUS IMAGE *******************
                Storage::disk('public')->delete($post->guid);
                // ****** DELETE PREVIOUS IMAGE *******************

                $imagePath = $request->file('file_upload');
                $original_name = $imagePath->getClientOriginalName();
                $extension = $imagePath->getClientOriginalExtension();
                //$path = $request->file('file_upload')->storeAs('pelouploads', $original_name, 'public');

                //$url = Storage::url($path);
                ////////////Storage::put($imagePath, $request->post_content);
                $validated['post_name'] = $original_name;
                //$validated['guid'] = $url;
                //$validated['guid'] = $path;
                /////////$validated['guid'] = 'storage/' .$path;
                $validated['post_mime_type'] = $extension;

                $image_file_resize = Image::make($imagePath->getRealPath());
                $image_file_resize->resize($x_size, $y_size);
                $image_resize = $image_file_resize->save(public_path('images/'.$original_name));
                $savedImagePath = public_path('images/'.$original_name);
                //$validated['post_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));
                //$validated['post_mine_base64'] = base64_encode(file_get_contents($image_resize));
                //$validated['post_mine_base64'] = base64_encode(file_get_contents(public_path('images/'.$original_name)));
                $validated['guid'] = $savedImagePath;
                $validated['post_mine_base64'] = base64_encode(file_get_contents($savedImagePath));

            }
            else {
                //$validated['guid'] = Str::slug($validated['post_title'], '-');
            }

            $post->update($validated);

            return back()->with('success', ' ' . $post->post_title . ' updated successfully.');


            // return redirect(route('posts.index'))->with('success', 'Category ' . $post->post_title . ' updated!');

        }
    }

// FUNCTION ON PAGES

public function menuindex()
{
    $posts = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.name')
        ->where('posts.post_type', '=', 'menu')
        ->get();

    //return view('view_admin.menu_index', compact('posts'))
    return view('view_admin.menu_create', compact('posts'))
        ->with('i', (request()->input('page', 1) -1) *5);
}

    public function menucreate()
    {
        return view('view_admin.menu_create');
    }


    public function menustore(Request $request)
    {
        $validated = $request->validate([
            'post_title' => 'required|unique:posts|min:2',
            'post_status' => 'required',
            'post_position' => 'required',
            'rank_menu' => 'required|numeric|min:0|max:100',
            'post_parent_category' => 'required'

        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['slug'] = Str::slug($validated['post_title'], '-');
        //$validated['post_status'] = $request->input('post_status');

        $validated['post_parent'] = $request->input('post_parent_category');
        $validated['post_name'] = $request->input('post_position');

        $validated['guid'] = Str::slug($validated['post_title'], '-');

        $validated['post_type'] = "menu";
        $validated['menu_order'] = $validated['rank_menu'];
        $validated['post_comment_count'] =0;
        //if ($request->filled('checked_to_ping')) {
        /*
        if ($request->has('checked_to_ping')){
            //$validated['post_priority'] = $request->input('checked_to_ping');
            $validated['post_priority'] = 1;
        }
        else {
            $validated['post_priority'] = 0;
        }
        */
        //$validated['post_caption'] = 'a';
        if($request->filled('external_link')) {
            //dd('user_id is not empty.');
            $validated['post_caption'] = $request->input('external_link');
        } else {
            //dd('user_id is empty.');
            $validated['post_caption'] = $validated['post_title'];
        }
        //$validated['external_link'] = $request->input('external_link');
        //$validated['external_link'] = $validated['post_description'] = $validated['post_caption'] = $request->input('external_link');
        $validated['external_link'] = $validated['post_description'] = $validated['post_caption'];

        if ($request->has('checked_product')){
            $validated['guid'] = 'ecommerce-product';
        }
        $post = Post::create($validated);
        $post->id;

        // OR******************************
        if ($request->has('checked_category')){
            foreach ($_POST['checked_category'] as $cate) {
                $post_option = new Postmeta;
                $post_option->post_id = $post->id;
                $post_option->post_parent_id = $cate;
                $post_option->save();
            }
        }

        // OR******************************
        if ($request->has('checked_product')){
            foreach ($_POST['checked_product'] as $cate) {
                $post_option = new ProductMeta;
                $post_option->product_id = $post->id;
                $post_option->product_parent_id = $cate;
                $post_option->save();
            }
        }

        return back()->with('success', 'Menu " ' . $post->post_title . '" created successfully.');

    }

    public function menuedit(Post $post)
    {
        return view('view_admin.menu_edit', compact('post'));

    }



    public function menuupdate(Request $request, Post $post)
    {
        // Validate posted form data
        $validated = $request->validate([
            'post_title' => 'required|min:2',
            'post_status' => 'required',
            'post_position' => 'required',
            'rank_menu' => 'required|numeric|min:0|max:100',
            'post_parent_category' => 'required'
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['slug'] = Str::slug($validated['post_title'], '-');
        $validated['post_parent'] = $request->input('post_parent_category');
        $validated['post_name'] = $request->input('post_position');
        $validated['guid'] = Str::slug($validated['post_title'], '-');

        $validated['post_type'] = "menu";
        $validated['menu_order'] = $validated['rank_menu'];

        $validated['post_comment_count'] =0;
        /*
        if ($request->has('checked_to_ping')){
            //$validated['post_priority'] = $request->input('checked_to_ping');
            $validated['post_priority'] = 1;
        }
        else {
            $validated['post_priority'] = 0;
        }
        */

        if($request->filled('external_link')) {
            //dd('user_id is not empty.');
            $validated['post_caption'] = $request->input('external_link');
        } else {
            //dd('user_id is empty.');
            $validated['post_caption'] = $validated['post_title'];
        }
        //$validated['external_link'] = $request->input('external_link');
        //$validated['external_link'] = $validated['post_description'] = $validated['post_caption'] = $request->input('external_link');
        $validated['external_link'] = $validated['post_description'] = $validated['post_caption'];


        $user = Post::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) and ((Auth::user()->permission) > (2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        } else {

            $posts = $post->update($validated);
            // DELETE OLD PARENT CATEGORIES
            //$deletedRows = Postmeta::where('post_id', $post->id)->delete();
            $deletedRows = Postmeta::where('post_id', $post->id)->delete();

            if ($request->has('checked_category')) {
                foreach ($_POST['checked_category'] as $cate) {
                    $post_option = new Postmeta;
                    $post_option->post_id = $post->id;
                    $post_option->post_parent_id = $cate;
                    $post_option->save();
                }
            }

            // OR******************************
            if ($request->has('checked_product')){
                foreach ($_POST['checked_product'] as $cate) {
                    $post_option = new ProductMeta;
                    $post_option->product_id = $post->id;
                    $post_option->product_parent_id = $cate;
                    $post_option->save();
                }
            }

            return back()->with('success', ' ' . $post->post_title . ' updated successfully.');

             //return redirect(route('menus.create'))->with('success', 'Menu updated successfully!');

        }
    }

    public function sliderindex()
    {
        return view('view_admin.slidershow_create');
    }

    public function slidercreate()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_mime_type', 'like', 'jpg%')
            //->where('posts.post_type', '=', 'menu')
            ->orWhere('posts.post_mime_type', 'like', 'png%')
            ->get();

        //return view('view_admin.menu_index', compact('posts'))
        return view('view_admin.slidershow_create', compact('posts'))
            ->with('i', (request()->input('page', 1) -1) *5);
        //return view('view_admin.slidershow_create');
    }
/*
DB::table('posts')
->where('post_type', 'article')
    //->orWhere('post_type', 'page')
    //->select('posts.*', 'users.name')
->get();

DB::table('users')
	->whereNull('name')
	->get();
SELECT * FROM users WHERE name IS NULL;

DB::table('users')
	->whereNotNull('name')
	->get();
SELECT * FROM users WHERE name IS NOT NULL;

    */


    public function sliderstore(Request $request)
    {
        $validated = $request->validate([
            'slider_title' => 'required|unique:slidershows|min:2',
            'slider_status' => 'required',
            'slider_caption' => 'required',
            'slider_description' => 'required',
            'linked_post' => 'required',
            'linked_image' => 'required',
            'slider_parent' => 'required'
            //'external_link' => 'required'
            //'slider_parent' => 'required'
            //'post_parent_category' => 'required'
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['slider_title'] = $request->input('slider_title');
        $validated['slider_status'] = $request->input('slider_status');
        $validated['slider_caption'] = $request->input('slider_caption');
        $validated['slider_description'] = $request->input('slider_description');
        $validated['slider_parent'] = $request->input('slider_parent');
        $validated['slider_type'] = 'slider';
        $validated['post_id'] = $request->input('linked_post');
        $validated['post_image_id'] = $request->input('linked_image');
        $validated['external_link'] = $request->input('external_link');

        $post = Slidershow::create($validated);
        $post->id;

        // OR******************************
        /*
        if ($request->has('checked_category')){
            foreach ($_POST['checked_category'] as $cate) {
                $post_option = new Postmeta;
                $post_option->post_id = $post->id;
                $post_option->post_parent_id = $cate;
                $post_option->save();
            }
        }
        */
        return back()->with('success', 'Slidershow " ' . $post->slider_title . '" created successfully.');

    }

    public function sliderdestroy(Slidershow $myslider)
    {
        //$user = Post::where('user_id', '=', (Auth::user()->id))->first();
        $user = Slidershow::where('user_id', '=', (Auth::user()->id))->first();
        if (($user === null) AND ((Auth::user()->permission)>(2))) {
            return back()->with('unauthorised', 'You are not authorised to update this post.');
        }

        else {
            //**************DELETE POSTMETAS*********************
            //Storage::disk('public')->delete('pelouploads/'.$post->post_name);
            //OR
            //Storage::disk('public')->delete($myslider->guid);
            //DB::table('postmetas')->where('post_id', '=', ($myslider->id))->delete();
            //************DELETE POST********************************************************
            $myslider->delete();

            return back()->with('success', ' ' . $myslider->slider_title . ' deleted successfully.');
            /*
            return redirect()->route('posts.index')
                ->with('success', 'Post ' . $post->post_title . ' deleted successfully');
            */
        }
    }


    public function messages_index()
    {
        $messages = Contact::latest()->where('folder', 'inbox')->paginate(5);
        /*
        $posts = DB::table('messages')
            //->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('posts.post_type', '=', 'article')
            ->get();

        return view('view_admin.article_index', compact('posts'))
            ->with('i', (request()->input('page', 1) -1) *5);
        //->with('i', (request()->input('page', 1) -1) *5);
        */
        return view('view_admin.message_inbox', compact('messages'))->with('i', (request()->input('page', 1) -1) *5);
        //return view('view_admin.message_read', compact('messages'))->with('i', (request()->input('page', 1) -1) *5);

    }
    public function messages_show(Contact $message)
    {
        Contact::where('id', $message->id)->update(['is_read' => 1]);
        //$messages = Contact::where('id', $message->id)->first();
        return view('view_admin.message_read', compact('message'))->with('i', (request()->input('page', 1) -1) *5);

    }
}
