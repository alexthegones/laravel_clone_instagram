<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user)
    {

        return view('profile.show', compact('user'));
    }

    public function edit(User $user)
    {
        // * Protège la fonction de modification de profile d'un user avec authorization ou non
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user->profile);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'image' => 'sometimes|image|max:2048'
        ]);
        if ($request['image']) {
            $path = $request->file('image')->store('avatars/' . $request->user()->username, 'public');
            // * Redimensionnement de l'image à l'issue d'un upload
            $image = Image::make(public_path("/storage/{$path}"))->fit(250, 250);
            $image->save();

            auth()->user()->profile->update(array_merge(
                $data,
                ['image' => $path]
            ));
        } else {
            auth()->user()->profile->update($data);// * Seul l'utilisateur connecté à son compte peut modifier son profil
        }

        return redirect()->route('profile.show', ['user' => $user]);// * Redirection vers le profil utilisateur
    }
}
