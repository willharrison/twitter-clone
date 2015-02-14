<?php namespace Twitter\Events;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Database\Eloquent\Model;
use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;
use Twitter\Post;

class UserPosted extends Event implements ShouldBeQueued {

	use SerializesModels;

	public $user, $postString, $postId;

	public function __construct(Model $user, $postString, $postId)
	{
		$this->user = $user;
		$this->postString = $postString;
		$this->postId = $postId;
	}

}
