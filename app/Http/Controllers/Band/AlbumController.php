<?php

namespace App\Http\Controllers\Band;

use Illuminate\Support\Str;
use App\Models\{Band, Album};
use App\Http\Controllers\Controller;
use App\Http\Requests\Band\AlbumRequest;

class AlbumController extends Controller
{
    public function create(){
        return view('albums.create', [
            'title' => 'New Album',
            'bands' => Band::get(),
            'submitLabel' => 'Create',
            'album' => new Album,
        ]);
    }

    public function store(AlbumRequest $request){
        $band = Band::find(request('band'));

        Album::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'band_id' => request('band'),
            'year' => request('year'),
        ]);

        return back()->with('success', 'Album was Created into '. $band->name);
    }

    public function table(){
        return view('albums.table', [
            'albums' => Album::paginate(16),
            'title' => 'Album',
        ]);
    }

    public function edit(Album $album){
        return view('albums.edit', [
            'title' => "Edit album: {$album->name}",
            'album' => $album,
            'submitLabel' => 'Update',
            'bands' => Band::get(),
        ]);
    }

    public function update(Album $album, AlbumRequest $request){
        $album->update([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'band_id' => request('band'),
            'year' => request('year'),
        ]);

        return redirect()->route('albums.table')->with('success', 'Album was updated');
    }


    public function getAlbumByBandId(Band $band){
        return $band->albums;
    }
    public function destroy(Album $album){
        $album->delete();
    }
}
