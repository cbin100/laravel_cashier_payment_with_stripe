<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Postmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Image;
class UploaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$posts = Post::latest()->paginate(5);
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('post_mime_type', '<>', '')
            ->where('post_mine_base64', '<>', '')
            //->where('posts.post_mime_type', 'like', 'jp%')
            //->orWhere('posts.post_mime_type', 'like', 'png%')
            ->select('posts.*', 'users.name')
            //->where('posts.post_type', '=', 'file')
            ->get();

        return view('view_admin.file_index', compact('posts'))
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    public function create()
    {
        return view('view_admin.file_create');
    }

    public function store(Request $request)
    {
        // Validate posted form data
        //
        $validated = $request->validate([
            //'name' => 'string|max:40',
            'post_title' => 'required|unique:posts|min:2',
            //'file_upload.*' => 'required|mimes:jpg,png,jpeg,gif,svg|max:9014'


        ]);
        $validated['post_title'] = $request->input('post_title');

        //$validated['post_author'] = Auth::user()->id;
        $validated['user_id'] = Auth::user()->id;
        // Create slug from title
        $validated['slug'] = Str::slug($validated['post_title'], '-');
        //$validated['post_name'] = $validated['post_title'];

        $validated['post_type'] = "file";
        //
        $validated['guid'] = $validated['slug'];
        //$request->file_upload->store('public/uploads');
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
        //
        if ($request->hasFile('file_upload'))
        {
            //  Let's do everything here
            //if ($request->file('file_upload')->isValid()) {
                //$request->file_upload->store('public/uploads');
                //foreach ($request->file('file_upload') as $key => $file) {
                foreach ($request->file('file_upload') as $file) {
                    //$file->store('public/uploads');
                    // STORE WITH RANDOM NAME
                    //$path = $file->store('public/pelouploads');
                    // GET ORIGINAL NAME
                    $imagePath = $file;
                    $original_name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    ///////$extension = $file->extension();
                    ////////////$extension = $request->image->extension();
                    /////////$request->image->storeAs('/public', $validated['name'].".".$extension);
                    ////$path = $file->storeAs('public/pelouploads', $original_name);
                    //
                    //$path = $file->storeAs('pelouploads', $original_name, 'public');
                    //
                    ////////////$request->image->storeAs('/public', $validated['name'].".".$extension);
                    /////////$url = Storage::url($validated['name'].".".$extension);

                    ///////////$url = Storage::url($path."/".$name.".".$extension);
                    /////////////$url = Storage::url('app/'.$path);
                    //$url = Storage::url($path);
                    $validated['post_name'] = $original_name;
                    //$validated['guid'] = $url;
                    //$validated['guid'] = $path;
                    $validated['post_mime_type'] = $extension;
                    //
                    //$validated['post_mine_base64'] = base64_encode(file_get_contents($file));
                    $image_file_resize = Image::make($imagePath->getRealPath());
                    $image_file_resize->resize($x_size, $y_size);
                    $image_resize = $image_file_resize->save(public_path('images/'.$original_name));
                    $savedImagePath = public_path('images/'.$original_name);
                    //$validated['post_mine_base64'] = base64_encode(file_get_contents($request->file('file_upload')));
                    //$validated['post_mine_base64'] = base64_encode(file_get_contents($image_resize));
                    //$validated['post_mine_base64'] = base64_encode(file_get_contents(public_path('images/'.$original_name)));
                    $validated['guid'] = $savedImagePath;
                    $validated['post_mine_base64'] = base64_encode(file_get_contents($savedImagePath));

                    $post = Post::create($validated);
                }
                Session::flash('success', "Success!");
                return \Redirect::back();
            //} else {
             //   Session::flash('unauthorised', "File not exist!");
             //   return \Redirect::back();
            //}
        } else {
            Session::flash('unauthorised', "File not exist!");
               return \Redirect::back();
        }

/*
        if($request->hasFile('profile_image')) {
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);

            if(!file_exists(public_path('storage/profile_images/crop'))) {
                mkdir(public_path('storage/profile_images/crop'), 0755);
            }

            // crop image
            $img = Image::make(public_path('storage/profile_images/'.$filenametostore));
            $croppath = public_path('storage/profile_images/crop/'.$filenametostore);

            $img->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'));
            $img->save($croppath);

            // you can save crop image path below in database
            $path = asset('storage/profile_images/crop/'.$filenametostore);

            //return redirect('image')->with(['success' => "Image cropped successfully.", 'path' => $path]);
        }
        */



        //abort(500, 'Could not upload image :(');



         /*
        if($request->TotalImages > 0)
        {
            for ($x = 0; $x < $request->TotalImages; $x++)
            {
                if ($request->hasFile('images'.$x))
                {
                    $file      = $request->file('images'.$x);

                    $path = $file->store('public/uploads');
                    $name = $file->getClientOriginalName();

                    $insert[$x]['name'] = $name;
                    $insert[$x]['path'] = $path;
                }
            }

            Photo::insert($insert);

            return response()->json(['success'=>'Multiple Image has been uploaded into db and storage directory']);


        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
        */

        }




}
