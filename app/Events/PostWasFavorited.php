<?php namespace Twitter\Events;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;
use Twitter\Post;
use Twitter\User;

class PostWasFavorited extends Event implements ShouldBeQueued {

	use SerializesModels;

	public $user, $post;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Post $post)
	{
		$this->user = $user;
		$this->post = $post;
	}

}
