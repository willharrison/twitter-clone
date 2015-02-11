<?php namespace Twitter\Events;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserRePosted extends Event implements ShouldBeQueued {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

}
