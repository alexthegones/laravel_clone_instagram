<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {

        return view('post.create');
    }

    public function store(Request $request)
    {
        // * Régles de validation appliqué aux différents champs
        $data = $request->validate([
            'caption' => 'required|string',
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('uploads/' . $request->user()->username, 'public');
        // * Redimensionnement de l'image à l'issue d'un upload
        $image = Image::make(public_path("/storage/{$path}"))->fit(1200,1200);
        $image->save();
        // * Insertion de l'image en bdd
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $path
        ]);

        return redirect()->route('profile.show', ['user' => auth()->user()]);
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }
}
