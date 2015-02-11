<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = "posts";

    public function user()
    {
        return $this->belongsTo('Twitter\User');
    }

    public function favorites()
    {
        return $this->hasMany('Twitter\Favorite');
    }

    public function reposts()
    {
        return $this->hasMany('Twitter\RePost');
    }

}
