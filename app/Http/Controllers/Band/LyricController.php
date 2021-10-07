<?php

namespace App\Http\Controllers\Band;

use App\Models\Band;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LyricController extends Controller
{
    public function create(){
        return view('lyrics.create', ['title' => 'New Lyric']);
    }
    public function store(){
        request()->validate([
            'album' => 'required',
            'band' => 'required',
            'body' => 'required',
            'title' => 'required',
        ]);
        $band = Band::find(request('band'));

        $band->lyrics()->create([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'album_id' => request('album')
        ]);
        return response()->json(['message' => 'The lyric wa created into band ' . $band->name]);
    }
}
