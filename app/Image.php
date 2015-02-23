<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $table = 'images';

    protected $fillable = ['user_id', 'post_id', 'actual', 'large',
        'medium', 'small', 'tiny'];

    public function user()
    {
        return $this->belongsTo('Twitter\User');
    }

    public function post()
    {
        return $this->belongsTo('Twitter\Post');
    }

}
