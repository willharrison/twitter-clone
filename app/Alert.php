<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model {

    protected $table = 'alerts';

    public function user()
    {
        return $this->belongsTo('Twitter\User');
    }
}
