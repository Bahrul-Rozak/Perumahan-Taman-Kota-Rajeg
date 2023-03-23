<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:photos.index|photos.create|photos.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::latest()->when(request()->q, function ($photos) {
            $photos = $photos->where('title', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.photo.index', compact('photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image',
            'caption'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/photos', $image->hashName());

        $photo = Photo::create([
            'image'     => $image->hashName(),
            'caption'   => $request->input('caption')
        ]);

        if ($photo) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.photo.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.photo.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $image = Storage::disk('local')->delete('public/photos/' . basename($photo->image));
        $photo->delete();

        if ($photo) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
