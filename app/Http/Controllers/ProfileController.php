<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // * Si l'user est connecté alors est-ce que cet user est deja abonné à ce profil ou non
        $follow = (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;

        $postsCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();

        $protect = \Illuminate\Support\Facades\Request::is('profile/' . auth()->user()->username);

        return view('profile.show', compact('user', 'follow', 'postsCount', 'followersCount', 'followingCount', 'protect'));
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
        // * Condition pour le champ - Si une image est stockée
        if ($request['image']) {
            $path = $request->file('image')->store('avatars/' . $request->user()->username, 'public');
            // * Redimensionnement de l'image à l'issue d'un upload
            $image = Image::make(public_path("/storage/{$path}"))->fit(250, 250);
            $image->save();
            // * Alors on récupère toujours les data mais en modifiant le chemin de l'image de la clé 'image'
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
