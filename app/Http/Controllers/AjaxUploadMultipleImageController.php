<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Photo;
class AjaxUploadMultipleImageController extends Controller
{
    public function index()
    {
        return view('view_admin.multiple-image-upload-preview-ajax');
    }

    public function saveUpload(Request $request)
    {

        $validatedData = $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

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

    }
}
