<?php namespace Twitter\Events;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;
use Twitter\User;

class UserRePosted extends Event implements ShouldBeQueued {

	use SerializesModels;

	public $user, $postOwnerId, $postId;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $postOwnerId, $postId)
	{
		$this->user = $user;
		$this->postOwnerId = $postOwnerId;
        $this->postId = $postId;
	}

}
