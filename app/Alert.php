<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model {

    protected $table = 'alerts';

    protected $fillable = ['user_id', 'message', 'post_id'];

    public function user()
    {
        return $this->belongsTo('Twitter\User');
    }
}
