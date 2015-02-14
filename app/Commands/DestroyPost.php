<?php namespace Twitter\Commands;

use Twitter\Commands\Command;

class DestroyPost extends Command {

	public $postId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($postId)
	{
		$this->postId = $postId;
	}

}
