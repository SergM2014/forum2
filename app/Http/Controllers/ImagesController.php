<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;



class ImagesController extends Controller
{
    public function uploadAvatar(Request $request)
    {

        $image = $request->file('file');
        $filename = strtolower(time().'.'.$image->getClientOriginalExtension());

        $destinationPath = storage_path('app/public/uploads/avatars');
        $savedFile = $destinationPath.'/'.$filename;

        $img = Image::make($image->getRealPath());
      //  $img->resize(150,150)->save($savedFile);
        $img->widen(150)->save($savedFile);

        chmod($savedFile,0777);


        echo json_encode(['success' => true, 'message'=> 'avatar is uploaded', 'image' => $filename ] );
        exit();
    }

    public function deleteAvatar(Request $request)
    {
        @unlink(storage_path('app/public/uploads/avatars/').$request->image);
        echo json_encode(['success' => true, 'message'=> 'avatar is deleted', 'image' => $request->image] );
        exit();
    }
}
