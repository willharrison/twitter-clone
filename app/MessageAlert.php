<?php namespace Twitter;

use Illuminate\Database\Eloquent\Model;

class MessageAlert extends Model {

    protected $table = "message_alerts";

    protected $fillable = ['user_id', 'message_id', 'message'];

}
