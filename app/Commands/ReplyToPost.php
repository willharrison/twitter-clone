<?php namespace Twitter\Commands;

use Twitter\Commands\Command;

class ReplyToPost extends Command {

	public $ownerId, $replyTo, $postString;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($ownerId, $replyTo, $postString)
	{
		$this->ownerId = $ownerId;
		$this->replyTo = $replyTo;
		$this->postString = $postString;
	}

}
