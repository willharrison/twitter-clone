<?php namespace Twitter\Commands;

use Twitter\Commands\Command;

class MuteUser extends Command {

	public $userId, $muteId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($userId, $muteId)
	{
		$this->userId = $userId;
		$this->muteId = $muteId;
	}

}
