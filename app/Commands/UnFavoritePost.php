<?php namespace Twitter\Commands;

use Twitter\Commands\Command;

class UnFavoritePost extends Command {

	public $userId, $postId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($userId, $postId)
	{
		$this->userId = $userId;
		$this->postId = $postId;
	}

}
