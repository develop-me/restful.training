<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Tag extends Model
{
    public $timestamps = false; // don't need timestamps
    protected $fillable = ["name"]; // name should be fillable
    protected $visible = ["id", "name"];
    protected $hidden = ["pivot"];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public static function parse(array $tagStrings)
    {
        $tags = new Collection();

        foreach ($tagStrings as $string) {
            $string = trim($string);
            $exists = Tag::where("name", $string)->first();
            $tags->push($exists ? : Tag::create(["name" => $string]));
        }

        return $tags;
    }
}
