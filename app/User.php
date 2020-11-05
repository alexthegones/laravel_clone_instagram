<?php

namespace App;

use App\Mail\WelcomeUserMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() // * Méthode concernant le traitement à la création(created)
    {
        parent::boot();

        static::created(function ($user) {
            // * Création du profil à la création d'un user
            $data = $user->profile()->create([
                'title' => 'Profil de ' . $user->username
            ]);
            // * Mail de bienvenue lors de la création d'un nouveau profil/user
            Mail::to($data->user->email)->send(new WelcomeUserMail());
        });
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function following() // * Abonnements
    {
        return $this->belongsToMany('App\Profile');
    }
}
