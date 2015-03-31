<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;
use Twitter\Services\PostParser;

class Post extends Model {

    protected $table = "posts";

    protected $fillable = ['user_id', 'post', 'parent_id'];

    public function user()
    {
        return $this->belongsTo('Twitter\User');
    }

    public function favorites()
    {
        return $this->hasMany('Twitter\Favorite');
    }

    public function parent()
    {
        return $this->belongsTo('Twitter\Post');
    }

    public function replies()
    {
        return $this->hasMany('Twitter\Post', 'parent_id', 'id');
    }
    public function reposts()
    {
        return $this->hasMany('Twitter\RePost');
    }

    public function hashtags()
    {
        return $this->belongsToMany('Twitter\Hashtag', 'hashtag_map', 'post_id', 'hashtag_id');
    }

    public function images()
    {
        return $this->hasMany('Twitter\Image');
    }
}
