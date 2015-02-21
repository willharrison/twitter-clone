<?php namespace Twitter\Commands;

use Twitter\Commands\Command;
use Twitter\User;

class ReplyToPost extends Command {

	public $user, $replyTo, $postString;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $replyTo, $postString)
	{
		$this->user = $user;
		$this->replyTo = $replyTo;
		$this->postString = $postString;
	}

}
