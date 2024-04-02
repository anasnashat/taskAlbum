<?php

namespace App\Http\Controllers;

use App\Http\Requests\Album\AlbumStoringRequest;
use App\Http\Requests\Album\AlbumUpdateRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $albums = Album::with('pictures')->paginate(20);
        return view('album.index',compact('albums'));
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
    public function store(AlbumStoringRequest $request)
    {
        $validData = $request->validated();
        try {
            $album =Album::create($validData);
            return to_route('albums.show',$album->id)->with('success','the album has been created');
        }catch (\Exception){
            return to_route('albums.index')->with('error','error happened while creating the album');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $album->load('pictures');

        return view('album.show',compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumUpdateRequest $request)
    {

        try {
            $album = Album::findOrFail($request->input('id'));
            $album->update($request->all());
            return to_route('albums.index')->with('success','the album has been updated successfully');

        } catch  (Throwable $e){
            return to_route('albums.index')->with('error','error happened throw album  update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $album = Album::findOrFail($request->input('id'));
            File::deleteDirectory('albums/'.$album->hashed_id);
            $album->delete();
            return to_route('albums.index')->with('success','the album has been deleted');
        } catch(Throwable $e){
            return to_route('albums.index')->with('error','error happened throw album  deleted');
        }
    }

    public function transferDataAndFiles(Request $request)
    {
        try {


        $sourceAlbum = Album::findOrFail($request->sourceAlbumId);
        $targetAlbum = Album::findOrFail($request->targetAlbumId);
        $targetAlbum->pictures()->saveMany($sourceAlbum->pictures);
        $sourceDirectory = public_path('albums/' . $sourceAlbum->hashed_id);

        $targetDirectory = public_path('albums/' . $targetAlbum->hashed_id);


        if (!File::isDirectory($targetDirectory)) {
            File::makeDirectory($targetDirectory, 0777, true, true);
        }


        $files = File::allFiles($sourceDirectory);

        foreach ($files as $file) {
            $filename = $file->getFilename();
            File::move($file->getPathname(), $targetDirectory . '/' . $filename);
        }
        File::deleteDirectory($sourceDirectory);
        $sourceAlbum->delete();
            return to_route('albums.index')->with('success','the album has been deleted');
        } catch(Throwable $e){
            return to_route('albums.index')->with('error','error happened throw album  deleted');
        }

    }

}
