<?php namespace Twitter\Commands;

use Twitter\Commands\Command;
use Twitter\User;

class StopFollowing extends Command {

	public $user, $followId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $followId)
	{
		$this->user = $user;
		$this->followId = $followId;
	}

}
