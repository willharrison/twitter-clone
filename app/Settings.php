<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $table = 'users_info';

    protected $fillable = ['language', 'country'];

    public function user()
    {
        return $this->belongsTo('Twitter\User');
    }
}
