<?php namespace Twitter\Commands;

use Twitter\Commands\Command;
use Twitter\User;

class StopMuting extends Command {

	public $user, $muteId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $muteId)
	{
		$this->user = $user;
		$this->muteId = $muteId;
	}

}
