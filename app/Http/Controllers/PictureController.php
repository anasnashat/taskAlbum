<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Album $album, Request $request)
    {

        $image = $request->file('file');
        $imageName = time().rand(1,99).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('albums/'.$album->hashed_id), $imageName);

// Since $imageName is just a single string, we don't need to loop through it
        Picture::create(['album_id' => $album->id, 'path' => $imageName]);

        return response()->json(['success' => $imageName]);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Album $album)
    {
//        dd($album);
        try {
            $picture = Picture::findOrFail($request->input('id'));

            $imagePath = 'albums/'.$album->hashed_id.'/'.$picture->path;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $picture->delete();

            return to_route('albums.show',$album->id)->with('success','the album has been deleted');
        } catch(Throwable $e){
            return to_route('albums.show',$album->id)->with('error','error happened throw album  deleted');
        }
    }
}
