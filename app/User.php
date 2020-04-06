<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function animalFacts()
    {
        return $this->hasMany(AnimalFact::class);
    }

    public function counter()
    {
        return $this->hasOne(Counter::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
