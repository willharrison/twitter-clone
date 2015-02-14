<?php namespace Twitter\Events;

use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserReplied extends Event {

	use SerializesModels;

	public $ownerId, $postId;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($ownerId, $postId)
	{
		$this->ownerId = $ownerId;
		$this->postId = $postId;
	}

}
