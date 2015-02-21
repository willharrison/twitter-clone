<?php namespace Twitter\Events;

use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;
use Twitter\User;

class UserReplied extends Event {

	use SerializesModels;

	public $user, $postString, $postId;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $postString, $postId)
	{
		$this->user = $user;
        $this->postString = $postString;
		$this->postId = $postId;
	}

}
