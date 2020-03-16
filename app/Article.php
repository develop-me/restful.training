<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Article extends Model
{
    protected $fillable = ["title", "content", "user_id"];
    protected $with = ["tags"];
    protected $hidden = ["user_id", "pivot"];

    public static function tagsForUser(User $user)
    {
        return $user->articles->pluck("tags")->flatten()->unique("id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function setTags(Collection $tags)
    {
        $this->tags()->sync($tags->pluck("id")->all());
        return $this;
    }
}
