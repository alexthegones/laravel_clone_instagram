<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($profile)
    {
        return auth()->user()->following()->toggle($profile); // * Si le profil est lié à l'utilisateur ou non avec toggle(Abonnement ou non)
    }
}
