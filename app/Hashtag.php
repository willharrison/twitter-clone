<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model {

    protected $table = "hashtag_index";

    protected $fillable = ['hashtag'];

    public function posts()
    {
        return $this->belongsToMany('Twitter\Post', 'hashtag_map', 'hashtag_id', 'post_id')
            ->orderBy('created_at', 'desc');
    }

}
