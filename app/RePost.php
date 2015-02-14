<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class RePost extends Model {

    protected $table = "reposts";

    protected $fillable = ['user_id', 'post_id'];

}
