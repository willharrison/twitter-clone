<?php namespace Twitter\Handlers\Events;

use Twitter\Events\UserRePosted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class UserRePostedHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserRePosted  $event
	 * @return void
	 */
	public function handle(UserRePosted $event)
	{
		//
	}

}
